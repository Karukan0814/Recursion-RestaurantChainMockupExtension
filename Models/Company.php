<?php

namespace Models;
use Interfaces\FileConvertible;



// Company クラス
class Company implements FileConvertible{

    private string $name;// 会社名（string）: 会社の名称
    private int $foundingYear;// 設立年（int）: 会社が設立された年
    private string $description;// 説明（string）: 会社の簡単な説明
    private string $website;// ウェブサイト（string）: 会社の公式ウェブサイトの URL
    private string $phone;// 電話（string）: 会社の連絡先電話番号
    private string $industry;// 業界（string）: 会社が事業を展開している業界
    private string $ceo;// CEO（string）: 会社の CEO の名前
    private bool $isPubliclyTraded;// 公開取引の有無（bool）: 会社が公開取引されているかどうかを示します
    private string $country;//国
    private string $founder;//創立者
    private int $totalEmployees;//総従業員数

    
    public function __construct(
        string $name,
        int $foundingYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPubliclyTraded,
        string $country,
        string $founder,
        int $totalEmployees
    ) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;  
        $this->phone = $phone;
        $this->industry = $industry;  
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;  
        $this->country = $country;
        $this->founder = $founder;
        $this->totalEmployees = $totalEmployees;



    }


    
    public function getName(): string {
        return $this->name;
    }

    public function getFoundingYear(): int {
        return $this->foundingYear;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getWebsite(): string {
        return $this->website;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getIndustry(): string {
        return $this->industry;
    }

    public function getCeo(): string {
        return $this->ceo;
    }

    public function isPubliclyTraded(): bool {
        return $this->isPubliclyTraded;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getFounder(): string {
        return $this->founder;
    }

    public function getTotalEmployees(): int {
        return $this->totalEmployees;
    }



    public function toString(): string {
        return sprintf(
            "Company Name: %s\nFoundingYear: %d \ndescription: %s\nwebsite: %s\nphone: %s\nindustry: %s\nceo: %s\nisPubliclyTraded: %s\ncountry: %s\nfounder: %s\ntotalEmployees: %d\n",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? 'true' : 'false',
            $this->country,
            $this->founder,
            $this->totalEmployees,


        );
    }

    public function toHTML() {
        return sprintf("
            <div class='company-card'>
                <div class='avatar'>SAMPLE</div>
                <h2>name: %s</h2>
                <p>foundingYear: %s</p>
                <p>description: %s</p>
                <p>website: %s</p>
                <p>phone: %s</p>
                <p>industry: %s</p>
                <p>ceo: %s</p>
                <p>isPubliclyTraded: %s</p>
                <p>country: %s</p>
                <p>totalEmployees: %s</p>

            </div>",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? 'true' : 'false',
            $this->country,
            $this->founder,
            $this->totalEmployees,
        );

       
    }

    public function toMarkdown() {
        $isPubliclyTradedString=$this->isPubliclyTraded ? 'true' : 'false';
        return "## name: {$this->name} 
                 - foundingYear: {$this->foundingYear}
                 - description: {$this->description}
                 - website: {$this->website}
                 - phone: {$this->phone}
                 - industry: {$this->industry}
                 - ceo: {$this->ceo}
                 - isPubliclyTraded: {$isPubliclyTradedString}
                 - country: {$this->country}
                 - founder: {$this->founder}
                 - phone: {$this->totalEmployees}";

    }

    public function toArray() {
        return [
            'name' => $this->name,
            'foundingYear' => $this->foundingYear,
            'description' => $this->description,
            'website' => $this->website,
            'phone' => $this->phone,
            'industry' => $this->industry,
            'ceo' => $this->ceo,
            'isPubliclyTraded' => $this->isPubliclyTraded ? 'true' : 'false',
            'country' => $this->country,
            'founder' => $this->founder,
            
            'totalEmployees' => $this->totalEmployees
        ];

    
    }


}

?>