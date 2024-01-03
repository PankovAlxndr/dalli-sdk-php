<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель с информацией о позиции (товаре) в заказе
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("item")
 */
class Item
{
    use Fillable;

    /**
     * Количество товаров
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("quantity")
     */
    private int $quantity;

    /**
     * Масса единицы товара в килограммах
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("weight")
     */
    private ?float $weight = null;

    /**
     * Масса единицы товара в килограммах (иногда ответ приходит именно в этом аттрибуте)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("mass")
     */
    private ?float $mass = null;

    /**
     * Цена за штуку
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("retprice")
     */
    private float $retPrice;

    /**
     * Оценочная стоимость за штуку
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("inshprice")
     */
    private ?float $inshPrice = null;

    /**
     * Штрих-код товара
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private ?string $barcode = null;

    /**
     * Артикул товара(необязательный). После добавления заявки в Забор (выгрузки из корзины)
     * будет объединен с наименованием в формате "АРТИКУЛ - НАЗВАНИЕ"
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("article")
     */
    private ?string $article = null;


    /**
     * Ставка НДС - целое число процентов. Если значение не указано, подставляется значение "20".
     * Значение "0" означает ставку "Без НДС", ставка "0%" на данный момент не поддерживается.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("VATrate")
     */
    private ?int $vatRate = null;

    /**
     * Код страны-производителя в соответствии с стандартом ISO_3166-1, например, "RU", "RUS" или "643" для России.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("origincountry")
     */
    private ?string $originCountry = null;

    /**
     * Номер ГТД
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("GTD")
     */
    private ?string $gtd = null;

    /**
     * Сумма акциза
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private ?float $excise = null;

    /**
     * Наименование компании поставщика, если отличается от заказчика
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("suppcompany")
     */
    private ?string $suppCompany = null;

    /**
     * Номер телефона компании поставщика, если отличается от заказчика
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("suppphone")
     */
    private ?string $suppPhone = null;

    /**
     * ИНН компании поставщика, если отличается от заказчика
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("suppINN")
     */
    private ?string $suppINN = null;

    /**
     * Код товарной номенклатуры. Используется для маркированных товаров ("Честный знак").
     * Нужно указывать все данные из нанесенного QR-кода, кроме нечитаемых символов (#29).
     * Если поле заполнено - поле quantity должно содержать только "1"
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("governmentcode")
     */
    private ?string $governmentCode = null;

    /**
     * Тип вложения. Принимает значения:
     *      1 - Товар. По умолчанию
     *      7 - Забор товара.
     * Если товар нужно у получателя забрать, возможно - вернуть деньги,
     * или его стоимость вычитается из суммы других товаров.
     * У такого товара в заявке будет отрицательное количество независимо от знака в запросе
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $type = 1;

    /**
     * Внутренний код товарной позиции
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("extcode")
     */
    private ?string $extCode = null;

    /**
     * Строка в формате JSON для отправки в ОФД.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("extraTags")
     */
    private ?string $extraTags = null;

    /**
     * Название товара
     *
     * @JMS\XmlValue
     * @JMS\Type("string")
     */
    private string $name;

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return Item
     */
    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return max($this->weight, $this->mass);
    }

    /**
     * @param float|null $weight
     *
     * @return Item
     */
    public function setWeight(?float $weight): Item
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getMass(): ?float
    {
        return $this->mass;
    }

    /**
     * @param float|null $mass
     *
     * @return Item
     */
    public function setMass(?float $mass): Item
    {
        $this->mass = $mass;
        return $this;
    }

    /**
     * @return float
     */
    public function getRetPrice(): float
    {
        return $this->retPrice;
    }

    /**
     * @param float $retPrice
     *
     * @return Item
     */
    public function setRetPrice(float $retPrice): Item
    {
        $this->retPrice = $retPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getInshPrice(): ?float
    {
        return $this->inshPrice;
    }

    /**
     * @param float|null $inshPrice
     *
     * @return Item
     */
    public function setInshPrice(?float $inshPrice): Item
    {
        $this->inshPrice = $inshPrice;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @param string|null $barcode
     *
     * @return Item
     */
    public function setBarcode(?string $barcode): Item
    {
        $this->barcode = $barcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArticle(): ?string
    {
        return $this->article;
    }

    /**
     * @param string|null $article
     *
     * @return Item
     */
    public function setArticle(?string $article): Item
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getVatRate(): ?int
    {
        return $this->vatRate;
    }

    /**
     * @param int|null $vatRate
     *
     * @return Item
     */
    public function setVatRate(?int $vatRate): Item
    {
        $this->vatRate = $vatRate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOriginCountry(): ?string
    {
        return $this->originCountry;
    }

    /**
     * @param string|null $originCountry
     *
     * @return Item
     */
    public function setOriginCountry(?string $originCountry): Item
    {
        $this->originCountry = $originCountry;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGtd(): ?string
    {
        return $this->gtd;
    }

    /**
     * @param string|null $gtd
     *
     * @return Item
     */
    public function setGtd(?string $gtd): Item
    {
        $this->gtd = $gtd;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getExcise(): ?float
    {
        return $this->excise;
    }

    /**
     * @param float|null $excise
     *
     * @return Item
     */
    public function setExcise(?float $excise): Item
    {
        $this->excise = $excise;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSuppCompany(): ?string
    {
        return $this->suppCompany;
    }

    /**
     * @param string|null $suppCompany
     *
     * @return Item
     */
    public function setSuppCompany(?string $suppCompany): Item
    {
        $this->suppCompany = $suppCompany;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSuppPhone(): ?string
    {
        return $this->suppPhone;
    }

    /**
     * @param string|null $suppPhone
     *
     * @return Item
     */
    public function setSuppPhone(?string $suppPhone): Item
    {
        $this->suppPhone = $suppPhone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSuppINN(): ?string
    {
        return $this->suppINN;
    }

    /**
     * @param string|null $suppINN
     *
     * @return Item
     */
    public function setSuppINN(?string $suppINN): Item
    {
        $this->suppINN = $suppINN;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGovernmentCode(): ?string
    {
        return $this->governmentCode;
    }

    /**
     * @param string|null $governmentCode
     *
     * @return Item
     */
    public function setGovernmentCode(?string $governmentCode): Item
    {
        $this->governmentCode = $governmentCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return Item
     */
    public function setType(int $type): Item
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExtCode(): ?string
    {
        return $this->extCode;
    }

    /**
     * @param string|null $extCode
     *
     * @return Item
     */
    public function setExtCode(?string $extCode): Item
    {
        $this->extCode = $extCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Item
     */
    public function setName(string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getExtraTags(): ?string
    {
        return $this->extraTags;
    }

    /**
     * @param null|string $extraTags
     *
     * @return Item
     */
    public function setExtraTags(?string $extraTags): Item
    {
        $this->extraTags = $extraTags;
        return $this;
    }
}
