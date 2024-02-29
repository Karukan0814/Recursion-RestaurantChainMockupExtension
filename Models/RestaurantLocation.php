<?php

namespace Models;

use DateTime;
use Interfaces\FileConvertible;

// RestaurantLocation クラスには、
// 場所の名前、住所、市区町村、州、郵便番号、および現在開いているかどうかを
// 表示するメソッドが必要です。

class RestaurantLocation implements FileConvertible
{
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees; //Employee[]

    private bool $isOpen;
    private bool $hasDriveThru;



    public function __construct(
        string $name,
        string $address,
        string $city,
        string $state,
        string $zipCode,
        array $employees,
        bool $isOpen,
        bool $hasDriveThru
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
        $this->hasDriveThru = $hasDriveThru;
    }


    public function toString(): string
    {
        return sprintf(
            "Name: %s %s\nAddress: %s\nCity: %s\nState: %s\nZip Code: %s\nIsOpen: %s\n",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->isOpen ? "True" : "False",


        );
    }


    public function getEmployeeHTML(): string
    {
        return implode(
            ' ',
            array_map(function (Employee $rl) {
                return  sprintf(
                    "<li>{$rl->toHTML()}</li>");
            }, $this->employees));
    }

    public function toHTML()
    {
        return sprintf(
            "
            <ul class='location-card'>
                <h3>LocationName: %s</h3>
                <li>%s, %s, %s</li>
                <li>Zip Code: %s</li>
                <li>IsOpen: %s</li>
                <li>Employees
                
                <ol>
                {$this->getEmployeeHTML()}
                </ol>
                </li>
            </ul>",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->isOpen ? "True" : "False",

        );
    }

    public function toMarkdown()
    {
        $isOpenString = $this->isOpen ? "True" : "False";
        return "## User: {$this->name} 
                 - Address: {$this->address}
                 - City: {$this->city}
                 - State: {$this->state}
                 - Zip Code: {$this->zipCode}
                 - isOpen: {$isOpenString}
   ";
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'isOpen' => $this->isOpen,



        ];
    }
}
