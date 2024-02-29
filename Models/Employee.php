<?php
namespace Models;

use DateTime;
use Interfaces\FileConvertible;
use Models\User;

class Employee extends User{
    

    protected string $position; //職種（string）: 従業員の職種
    protected float $salary;//給与（float）: 従業員の給与
    protected DateTime $startDate;//開始日（DateTime）: 従業員がレストランでの雇用を開始した日付
    protected array $awardList; //賞（array）: 従業員が獲得した賞の配列

    





    public function __construct(int $id, string $firstName, string $lastName, string $email, 
    string $password, string $phoneNumber, string $address, 
    DateTime $birthDate, DateTime $membershipExpirationDate, string $role,string $position,float $salary,DateTime $startDate,
    array $awardList ) {
        parent::__construct($id, $firstName, $lastName, $email, 
        $password, $phoneNumber,$address, 
        $birthDate, $membershipExpirationDate, $role);
        $this->position = $position;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awardList = $awardList;



    }


    public function toString(): string {
        $parentString = parent::toString();
        return $parentString . sprintf(
            "Position: %s\nSalary: %.2f\nStart Date: %s\nAwards: %s\n",
            $this->position,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awardList)
        );
    }

    public function toHTML() {
        // $parentHTML = parent::toHTML();
        $parentProperties=parent::toArray();
        return sprintf("
        <ul>
        <h4> %s</h4>
        <li>Position: %s</li>
        <li>Salary: %.2f</li>
        <li>Start Date: %s</li>
        <li>Awards: %s</li>
        </ul>",
        $parentProperties["firstName"]." ".$parentProperties["lastName"],
        $this->position,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awardList)
        );
    }

    public function toMarkdown() {
        $parentMarkdown = parent::toMarkdown();
        return $parentMarkdown . sprintf("
                 - Position: %s
                 - Salary: %.2f
                 - Start Date: %s
                 - Awards: %s",
            $this->position,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awardList)
        );
    }

    public function toArray() {
        $parentArray = parent::toArray();
        return array_merge($parentArray, [
            'position' => $this->position,
            'salary' => $this->salary,
            'startDate' => $this->startDate,
            'awardList' => $this->awardList
        ]);
    }

}
?>