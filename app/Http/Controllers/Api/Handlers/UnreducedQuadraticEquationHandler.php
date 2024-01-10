<?php


namespace App\Http\Controllers\Api\Handlers;


use Illuminate\Support\Str;

/**
 * Класс UnreducedQuadraticEquationHandler
 *
 * Генерирует не приведенное квадратное уравнение
 *
 * @package App\Http\Controllers\Api\Handlers
 */
class UnreducedQuadraticEquationHandler  extends AbstractHandler
{
    /**
     * Метод обработчика
     *
     * @return $this
     */
    protected function handle (): self
    {
        // Генерируем ответы
        $x1 = $this->rand();
        $x2 = $this->rand();

        // Генерируем и находим параметры

        $a = $this->rand([0, 1], -9, 9);
        $b = -($x1 + $x2) * $a;
        $c = $x1 * $x2 * $a;

        // Подготавливаем формулу
        $formula = $this->getDefaultFormula();
        $vars = [
            'a' => $a,
            'b' => $b,
            'c' => $c,
        ];

        foreach ($vars as $k => $v) {
            $nextSymbol = substr($formula, strpos($formula, $k) + 1, 1);
            $prevSymbol = substr($formula, strpos($formula, $k) - 1, 1);
            $substr = substr($formula, strpos($formula, $k) - 1, 2);

            if ($nextSymbol === 'x') {
                if (!in_array($prevSymbol, ['+', '-'])) {
                    $search = $k;

                    if (abs($v) === 1) {
                        $replace = $v === 1 ? '' : '-';
                    } else {
                        $replace = $v;
                    }
                } else {
                    $search = $substr;

                    if (abs($v) === 1) {
                        $replace = $v === 1 ? '+' : '-';
                    } else {
                        $replace = $v > 0 ? '+' . abs($v) : '-' . abs($v);
                    }
                }
            } else {
                $search = $substr;
                $replace = $v > 0 ? '+' . abs($v) : '-' . abs($v);
            }

            $formula = Str::of($formula)->replace($search, $replace);
        }

        return $this->fill($formula, [$x1, $x2], [$a, $b, $c]);
    }
}
