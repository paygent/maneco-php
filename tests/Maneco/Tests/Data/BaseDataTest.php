<?php

namespace Maneco\Tests\Data;

class BaseDataTest extends \PHPUnit_Framework_TestCase
{

    public function test()
    {
        $child1 = $this->getMockBuilder('Maneco\Data\BaseData')->setConstructorArgs(array(
             array(
                     "k3_1" => 123,"k3_2" => "v3_2"
             )
        ))->getMockForAbstractClass();
        $child2 = $this->getMockBuilder('Maneco\Data\BaseData')->setConstructorArgs(array(
             array(
                     "k4_1_1" => true,"k4_1_2" => "v4_1_2"
             )
        ))->getMockForAbstractClass();
        $child4 = $this->getMockBuilder('Maneco\Data\BaseData')->setConstructorArgs(array(
        		array(
        				"k4_2_2_1" => false,"k4_2_2_2" => "v4_2_2_2"
        		)
        ))->getMockForAbstractClass();
        $child3 = $this->getMockBuilder('Maneco\Data\BaseData')->setConstructorArgs(array(
             array(
                     "k4_2_1" => false,"k4_2_2" => $child4
             )
        ))->getMockForAbstractClass();
        $parent = $this->getMockBuilder('Maneco\Data\BaseData')->setConstructorArgs(array(
             array(
                     "k1" => "v1","k2" => null,"k3" => $child1,"k4" => array(
                             $child2,$child3
                     )
             )
        ))->getMockForAbstractClass();
        echo $parent->k1 . "\n";
        echo $parent->k2 . "\n";
        echo $parent->k3->k3_1 . "\n";
        echo var_export($parent->k4[0]->k4_1_1, true) . "\n";
        echo var_export($parent->k4[1]->k4_2_1, true) . "\n";
        echo $parent->k4[1]->k4_2_2->k4_2_2_2 . "\n";
        echo $parent;
    }
}
