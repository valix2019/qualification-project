<?php


namespace App\Http\Controllers\Api\Handlers;


use Illuminate\Support\Str;

/**
 * Класс BracketsQuadraticEquationHandler
 *
 * Генерирует квадратное уравнение с раскрытием скобок
 *
 * @package App\Http\Controllers\Api\Handlers
 */
class BracketsQuadraticEquationHandler  extends AbstractHandler
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

        $a = $this->rand([0]);
        $d = 0;

        // Подготавливаем формулу
        $formula = $this->getDefaultFormula();
        $vars = [
            'a' => $a,
            'y' => $x1,
            'z' => $x2,
            'd' => $d,
        ];

        foreach ($vars as $k => $v) {
            $nextSymbol = substr($formula, strpos($formula, $k) + 1, 1);
            $prevSymbol = substr($formula, strpos($formula, $k) - 1, 1);
            $substr = substr($formula, strpos($formula, $k), 1);

            if ($nextSymbol === '(') {
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
                if ($prevSymbol === '=') {
                    $search = $substr;
                    $replace = $v >= 0 ? abs($v) : '-' . abs($v);
                } else {
                    $search = substr($formula, strpos($formula, $k) - 1, 2);
                    $replace = $v >= 0 ? '-' . abs($v) : '+' . abs($v);
                }
            }

            $formula = Str::of($formula)->replace($search, $replace);
        }

        return $this->fill($formula, [$x1, $x2], [$a, $d]);
    }
}
