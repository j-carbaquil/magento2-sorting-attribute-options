<?php

namespace Jston\SortingOptions\Plugin\Model\ResourceModel\Attribute;

class Save
{
    /**
     * Before save handler
     *
     * @param \Magento\Catalog\Model\ResourceModel\Attribute $subject
     * @param \Magento\Framework\Model\AbstractModel $object
     *
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSave(
        \Magento\Catalog\Model\ResourceModel\Attribute $subject,
        \Magento\Framework\Model\AbstractModel $object
    ) {
        $attributeOption = $object->getOption();

        uasort($attributeOption['value'], function($a, $b) {
            $a[0] = strtolower($a[0]);
            $b[0] = strtolower($b[0]);
            return $a[0] <=> $b[0];
        });

        $counter = 1;
        foreach ($attributeOption['value'] as $key => $val) {
            $attributeOption['order'][$key] = $counter;
            $counter++;
        }

        $object->setOption($attributeOption);
    }
}
