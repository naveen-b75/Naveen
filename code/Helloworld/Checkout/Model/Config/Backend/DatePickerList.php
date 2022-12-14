<?php

namespace Helloworld\Checkout\Model\Config\Backend;

class DatePickerList extends \Magento\Config\Model\Config\Backend\Serialized\ArraySerialized
{
    /**
     *
     *
     * @return $this
     */
    public function beforeSave()
    {
        $value = [];
        $values = $this->getValue();
        foreach ((array)$values as $key => $data) {
            if ($key == '__empty') continue;
            if (!isset($data['date'])) continue;
            try {
                $date = \DateTime::createFromFormat('d/m/Y', $data['date']);
                $value[$key] = [
                    'date' => $date->format('Y-m-d'),
                    'content' => $data['content'],
                ];
            } catch (\Exception $e) {
                // Just skipping error values
            }
        }
        $this->setValue($value);
        return parent::beforeSave();
    }
}