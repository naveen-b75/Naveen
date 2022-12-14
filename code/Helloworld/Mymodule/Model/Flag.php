<?php

namespace Helloworld\Mymodule\Model;

class Flag extends \Magento\Framework\Flag
{
    const REPORT_PRODUCTREPORT_FLAG_CODE = 'report_productreport_aggregated';

    public function setReportFlagCode($code)
    {
        $this->_flagCode = $code;
        return $this;
    }
}