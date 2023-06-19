<?
class NullHandler {
    private $defaultValues = [];

    public function __get($name) {
        return $this->$name ?? $this->defaultValues[$name] ?? '';
    }

    protected function setDefaultValues(array $values) {
        $this->defaultValues = $values;
    }
}
?>