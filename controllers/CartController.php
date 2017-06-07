<?php

namespace app\controllers;

use app\controllers\AppController;
use Yii;
use app\models\Product;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;

class CartController extends AppController {

    public function actionAdd($id, $qty) {
        //$id = \Yii::$app->request->get('id');

        $qty = (int) $qty; // приводим к целому числу
        $qty = !$qty ? 1 : $qty; // если null то присваиваем 1, или сохраняем прежнее значение

        $product = Product::findOne($id); //Находим товар
        if (empty($product))
            return FALSE; // Если товара нет, то останавливаемся

        $session = \Yii::$app->session; // Создаем сессию
        $session->open(); // Открываем сессию

        $cart = new Cart(); // Cоздаем модель корзины
        $cart->addToCart($product, $qty); // Помещаем в корзину товар и количество

        $this->layout = FALSE; // Отключаем основной шаблон

        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear() {
        $session = \Yii::$app->session; // Создаем сессию
        $session->open(); // Открываем сессию
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        $this->layout = FALSE; // Отключаем основной шаблон

        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem() {
        $id = \Yii::$app->request->get('id');
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);

        $this->layout = FALSE; // Отключаем основной шаблон

        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow() {
        $session = \Yii::$app->session;
        $session->open();

        $this->layout = FALSE; // Отключаем основной шаблон

        return $this->render('cart-modal', compact('session'));
    }

    public function actionView() {
        // session
        $session = \Yii::$app->session;
        $session->open();

        //set metatags
        $this->setMetatag('Корзина');

        $order = new Order();

        if ($order->load(\Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);

                // отправляем почту пользователю
                Yii::$app->mailer->compose('order', ['session' => $session])
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['siteName']])
                        ->setTo($order->email)
                        ->setSubject(Yii::$app->params['siteName'] . ' - Ваш заказ')
                        ->send();

                // отправляем почту администратору
                Yii::$app->mailer->compose()
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['siteName']])
                        ->setTo(Yii::$app->params['adminEmail'])
                        ->setSubject(Yii::$app->params['siteName'] . ' - Новый заказ')
                        ->setTextBody('Внимание! На сайт поступил новый заказ.')
                        ->send();

                // очищаем корзину
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                \Yii::$app->session->setFlash('success', 'Ваш заказ принят.');
                return $this->refresh(); // перезагружаем страницу
            } else {
                \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа.');
            }
        }

        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id) {
        foreach ($items as $id => $item) {
            $order_items = new OrderItems();

            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];

            $order_items->save();
        }
    }

}
