<?php


namespace App\Http\Controllers\Api\Handlers;


use App\Http\Controllers\Api\Handlers\Traits\Metable;
use Illuminate\Support\Arr;

/**
 * Класс AbstractHandler
 *
 * Основной абстрактный класс для всех обработчиков
 *
 * @package App\Http\Controllers\Api\Handlers
 */
abstract class AbstractHandler implements \JsonSerializable
{
    use Metable;

    /**
     * AbstractHandler конструктор.
     *
     * @param  string  $defaultFormula
     */
    public function __construct(string $defaultFormula)
    {
        $this->setDefaultFormula($defaultFormula);
    }

    /**
     * Формула по умолчанию
     *
     * @var string
     */
    private string $defaultFormula;

    /**
     * Формула
     *
     * @var string
     */
    private string $formula;

    /**
     * Ответы
     *
     * @var array
     */
    private array $answers = [];

    /**
     * Параметры
     *
     * @var array
     */
    private array $params = [];

    /**
     * Метод обработчика
     *
     * @return $this
     */
    abstract protected function handle (): self;

    /**
     * Найти или сгенерировать обработчик
     *
     * @return $this
     */
    public function findOrGenerate (): self
    {
        if ($this->isGenerated()) {
            $handler = $this->findHandler();

            $this->fill(
                $handler->getFormula(),
                $handler->getAnswers(),
                $handler->getParams()
            );
        } else {
            $this->generate();
        }

        return $this;
    }

    /**
     * Сгенерировать обработчик
     *
     * @return $this
     */
    public function generate (): self
    {
        $this->handle()->saveHandler();

        return $this;
    }

    /**
     * Проверить корректность ответов
     *
     * @param  array  $answers
     *
     * @return bool
     */
    public function check (array $answers): bool
    {
        return empty(array_diff($this->getAnswers(), $answers));
    }

    /**
     * Заполнить данными обработчик
     *
     * @param  string  $formula
     * @param  array  $answers
     * @param  array  $params
     *
     * @return $this
     */
    protected function fill (string $formula, array $answers, array $params): self
    {
        $this->setFormula($formula);
        $this->setAnswers($answers);
        $this->setParams($params);

        return $this;
    }

    /**
     * Проверить существование обработчика
     *
     * @return bool
     */
    private function isGenerated (): bool
    {
        return session()->exists(static::class);
    }

    /**
     * Найти обработчик в сессии
     *
     * @return $this|null
     */
    private function findHandler (): ?self
    {
        if (!$this->isGenerated())
            return null;

        $data = session()->get(static::class);
        $handler = clone $this;

        return $handler->fill(
            Arr::get($data, 'formula'),
            Arr::get($data, 'answers'),
            Arr::get($data, 'params')
        );
    }

    /**
     * Сохранить обработчик в сессию
     *
     * @return $this
     */
    private function saveHandler (): self
    {
        session()->put(static::class, $this->jsonSerialize());
        session()->save();

        return $this;
    }

    /**
     * Получить формулу по умолчанию
     *
     * @return string
     */
    protected function getDefaultFormula (): string
    {
        return $this->defaultFormula;
    }

    /**
     * Установить формулу по умолчанию
     *
     * @param  string  $defaultFormula
     *
     * @return $this
     */
    private function setDefaultFormula (string $defaultFormula): self
    {
        $this->defaultFormula = $defaultFormula;
        return $this;
    }

    /**
     * Получить формулу
     *
     * @return string
     */
    private function getFormula (): string
    {
        return $this->formula;
    }

    /**
     * Установить формулу
     *
     * @param  string  $formula
     *
     * @return $this
     */
    private function setFormula (string $formula): self
    {
        $this->formula = $formula;
        return $this;
    }

    /**
     * Получить ответы
     *
     * @return array
     */
    private function getAnswers (): array
    {
        return $this->answers;
    }

    /**
     * Установить ответы
     *
     * @param  array  $answers
     *
     * @return $this
     */
    private function setAnswers (array $answers): self
    {
        $this->answers = $answers;
        return $this;
    }

    /**
     * Получить параметры
     *
     * @return array
     */
    private function getParams (): array
    {
        return $this->params;
    }

    /**
     * Установить параметры
     *
     * @param  array  $params
     *
     * @return $this
     */
    private function setParams (array $params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Сгенерировать случайное число
     *
     * @param  array  $except
     * @param  int  $min
     * @param  int  $max
     *
     * @return int
     */
    protected function rand (array $except = [], int $min = -99, int $max = 99): int
    {
        do {
            $int = mt_rand($min, $max);
        } while (in_array($int, $except));

        return $int;
    }

    /**
     * Подготовить для сериализации JSON
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(
            [
                'formula' => $this->getFormula(),
                'answers' => $this->getAnswers(),
                'params' => $this->getParams(),
            ],
            $this->meta()
        );
    }
}
