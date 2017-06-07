<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord {

    public function addToCart($product, $qty = 1) {

        // Если в сессии уже есть данный товар
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty; // то к количеству приплюсовываем еще количество
        } else {
            // иначе, создаем в сессии товар
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        }

        // Подводим итоги
        //
        // если общее количество уже есть, то суммируем его с новым количеством,
        // иначе сохраняем в нем переданное количество
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ?
                $_SESSION['cart.qty'] + $qty :
                $qty;

        // если общяя сумма уже есть, то суммируем ее с новым количеством * цену,
        // иначе сохраняем в общую сумму количество * цену
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ?
                $_SESSION['cart.sum'] + $qty * $product->price :
                $qty * $product->price;
    }

    public function recalc($id) {
        if (!isset($_SESSION['cart'][$id]))
            return FALSE;
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        // пересчет
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        // Удаляем товар
        unset($_SESSION['cart'][$id]);
    }

}
