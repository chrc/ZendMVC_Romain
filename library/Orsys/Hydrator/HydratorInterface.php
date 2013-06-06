<?php


interface Orsys_Hydrator_HydratorInterface {
    public function populate($obj, $array);
    public function toArray($obj);
}
