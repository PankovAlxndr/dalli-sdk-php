<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Models\Responses\Error;
use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель заявки (заказа)
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("order")
 */
class Order
{
    use Fillable;

    /**
     * Штрих-код заказа в системе Dalli (аттрибут)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private ?string $barcode = null;

    /**
     * Номер заявки в учетной системе ИМ (обязательный атрибут)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("number")
     */
    private string $number;

    /**
     * Информации о получателе (обязательный тег)
     *
     * @JMS\Type("DalliSDK\Models\Receiver")
     * @JMS\SerializedName("receiver")
     */
    private Receiver $receiver;

    /**
     * Код торговой точки (для использования необходимо согласование с персональным менеджером).
     * Работает только для экспресс доставки (код 2).
     * При другом типе доставки игнорируется
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("department")
     */
    private ?string $department = null;

    /**
     * Тип доставки (код из соответствующего справочника). Обязательный тег
     *
     * @see https://api.dalli-service.com/v1/doc/request-types-of-delivery
     * @JMS\Type("int")
     * @JMS\SerializedName("service")
     */
    private int $service;

    /**
     * Общий вес в килограммах (если пусто = 0.1)
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("weight")
     *
     * @deprecated since version 1.5.0
     */
    private ?float $weight = null;

    /**
     * Количество мест, не путать с количеством товара (если пусто = 1)
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("quantity")
     */
    private int $quantity;

    /**
     * Тип оплаты получателем (если пусто или неверно = cash)
     * Может быть:
     *  CASH - наличными, при получении (по умолчанию)
     *  CARD - картой, при получении
     *  NO - без оплаты, поле price будет обнулено
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("paytype")
     */
    private ?string $payType = null;


    /**
     * Тип услуги Почты России
     * Может быть:
     *  1 - Посылка онлайн
     *  2 - Курьер онлайн
     *  3 - Посылка нестандартная
     *  4 - Посылка 1-го класса
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("type")
     */
    private ?int $ruPostType = null;

    /**
     * Сумма наложенного платежа
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("price")
     */
    private ?float $price = null;

    /**
     * Стоимость доставки.
     * Её возьмут с получателя в любом случае, если курьер был на адресе
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("priced")
     */
    private ?float $priced = null;

    /**
     * Объявленная ценность
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("inshprice")
     */
    private ?float $inshPrice = null;

    /**
     * Признак необходимости возврата (T - нужен возврат, F -  не нужен возврат)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("upsnak")
     */
    private ?string $upsnak = null;

    /**
     * Поручение, примечание для курьера
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("instruction")
     */
    private ?string $instruction = null;

    /**
     * Разрешение/запрет частичного выкупа.
     * Принимает значения:
     *  YES - когда частичный выкуп доступен,
     *  NO - если не доступен.
     * По-умолчанию берётся значение из карточки клиента
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("acceptpartially")
     */
    private ?string $acceptpartially = null;

    /**
     * Настройка дифференциальной стоимости доставки
     * Внимание! При явном указании дифференциальной стоимости доставки игнорируется тег priced, а так же настройки Личного Кабинета.
     * Если у вас одинаковые условия по стоимости доставки для всех заявок, тогда вы можете задать их глобально в Личном Кабинете
     *
     * @see https://api.dalli-service.com/v1/doc/request-types-of-delivery
     * @JMS\Type("DalliSDK\Models\DeliverySet")
     * @JMS\SerializedName("deliveryset")
     */
    private DeliverySet $deliverySet;

    /**
     * Корневой контейнер вложений (товаров)
     *
     * @JMS\Type("array<DalliSDK\Models\Item>")
     * @JMS\XmlList(entry = "item")
     * @JMS\SerializedName("items")
     * @var Item[]
     */
    private ?array $items = null;

    /**
     * Корневой контейнер мест (грузоместа)
     * Для получения доступа к добавлению мест обратитесь к вашему менеджеру. По умолчанию, данная опция недоступна.
     *
     * @JMS\Type("array<DalliSDK\Models\Packages>")
     * @JMS\XmlList(entry = "package")
     * @JMS\SerializedName("packages")
     * @var Package[]
     */
    private ?array $packages = null;

    /**
     * Если запрос был с ошибкой, то ответ мапится сюда
     *
     * @JMS\Type("array<DalliSDK\Models\Responses\Error>")
     * @JMS\XmlList(inline = false, entry = "error")
     * @var Error[]
     *
     */
    private ?array $errors = null;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return Order
     */
    public function setNumber(string $number): Order
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return Receiver
     */
    public function getReceiver(): Receiver
    {
        return $this->receiver;
    }

    /**
     * @param Receiver $receiver
     *
     * @return Order
     */
    public function setReceiver(Receiver $receiver): Order
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        return $this->department;
    }

    /**
     * @param string|null $department
     *
     * @return Order
     */
    public function setDepartment(?string $department): Order
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return int
     */
    public function getService(): int
    {
        return $this->service;
    }

    /**
     * @param int $service
     *
     * @return Order
     */
    public function setService(int $service): Order
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return float|null
     * @deprecated deprecated since version 1.5.0
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float|null $weight
     * @deprecated deprecated since version 1.5.0
     * @return Order
     */
    public function setWeight(?float $weight): Order
    {
        $this->weight = $weight;
        return $this;
    }

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
     * @return Order
     */
    public function setQuantity(int $quantity): Order
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPayType(): ?string
    {
        return $this->payType;
    }

    /**
     * @param string|null $payType
     *
     * @return Order
     */
    public function setPayType(?string $payType): Order
    {
        $this->payType = $payType;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     *
     * @return Order
     */
    public function setPrice(?float $price): Order
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriced(): ?float
    {
        return $this->priced;
    }

    /**
     * @param float|null $priced
     *
     * @return Order
     */
    public function setPriced(?float $priced): Order
    {
        $this->priced = $priced;
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
     * @return Order
     */
    public function setInshPrice(?float $inshPrice): Order
    {
        $this->inshPrice = $inshPrice;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpsnak(): ?string
    {
        return $this->upsnak;
    }

    /**
     * @param string|null $upsnak
     *
     * @return Order
     */
    public function setUpsnak(?string $upsnak): Order
    {
        $this->upsnak = $upsnak;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    /**
     * @param string|null $instruction
     *
     * @return Order
     */
    public function setInstruction(?string $instruction): Order
    {
        $this->instruction = $instruction;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAcceptpartially(): ?string
    {
        return $this->acceptpartially;
    }

    /**
     * @param string|null $acceptpartially
     *
     * @return Order
     */
    public function setAcceptpartially(?string $acceptpartially): Order
    {
        $this->acceptpartially = $acceptpartially;
        return $this;
    }

    /**
     * @return DeliverySet
     */
    public function getDeliverySet(): DeliverySet
    {
        return $this->deliverySet;
    }

    /**
     * @param DeliverySet $deliverySet
     *
     * @return Order
     */
    public function setDeliverySet(DeliverySet $deliverySet): Order
    {
        $this->deliverySet = $deliverySet;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getItems(): ?array
    {
        return $this->items;
    }

    /**
     * @param array|null $items
     *
     * @return Order
     */
    public function setItems(?array $items): Order
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getPackages(): ?array
    {
        return $this->packages;
    }

    /**
     * @param array|null $packages
     *
     * @return Order
     */
    public function setPackages(?array $packages): Order
    {
        $this->packages = $packages;
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
     * @param string $barcode
     *
     * @return Order
     */
    public function setBarcode(string $barcode): Order
    {
        $this->barcode = $barcode;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @return int|null
     */
    public function getRuPostType(): ?int
    {
        return $this->ruPostType;
    }

    /**
     * @param int|null $ruPostType
     *
     * @return Order
     */
    public function setRuPostType(?int $ruPostType): Order
    {
        $this->ruPostType = $ruPostType;
        return $this;
    }
}
