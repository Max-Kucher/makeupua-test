# Task:

```php
class Foo
{
    // TODO: оптимізувати загальний час роботи при 100 rps
    public function getBar()
    {
        $result = Cache::get('bar');
        if ($result !== null) {
            return $result;
        }

        $result = BlackBox::getBar(); // 1s
        Cache::put('bar', $result);

        return $result;
    }
}

```
