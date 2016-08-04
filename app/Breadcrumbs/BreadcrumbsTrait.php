<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/2/16
 * Time: 1:54 PM
 */

namespace App\Breadcrumbs;


trait BreadcrumbsTrait
{
    public function getModelUrl()
    {
        return $this->breadcrumbs['base_url'] . $this->{$this->breadcrumbs['unique']};
    }

    public function getModelParent()
    {
        return $this->breadcrumbs['parent'] ?  $this->{$this->breadcrumbs['parent']} : null;
    }

    public function getBreadcrumbName()
    {
        return $this->{$this->breadcrumbs['build_name_from']};
    }
}