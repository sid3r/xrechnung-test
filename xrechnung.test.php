<?php

use horstoeko\zugferd\ZugferdDocumentBuilder;
use horstoeko\zugferd\ZugferdProfiles;
use horstoeko\zugferd\codelists\ZugferdPaymentMeans;

require dirname(__FILE__) . "/vendor/autoload.php";

$document = ZugferdDocumentBuilder::CreateNew(
    ZugferdProfiles::PROFILE_XRECHNUNG_3
);
$document
    ->setDocumentInformation(
        "471102",
        "380",
        \DateTime::createFromFormat("Ymd", "20180305"),
        "EUR"
    )
    ->addDocumentNote("Rechnung gemäß Bestellung vom 01.03.2018.")
    ->addDocumentNote(
        "Lieferant GmbH" .
            PHP_EOL .
            "Lieferantenstraße 20" .
            PHP_EOL .
            "80333 München" .
            PHP_EOL .
            "Deutschland" .
            PHP_EOL .
            "Geschäftsführer: Hans Muster" .
            PHP_EOL .
            "Handelsregisternummer: H A 123" .
            PHP_EOL .
            PHP_EOL,
        null,
        "REG"
    )
    ->setDocumentSupplyChainEvent(
        \DateTime::createFromFormat("Ymd", "20180305")
    )
    ->addDocumentPaymentMean(
        ZugferdPaymentMeans::UNTDID_4461_58,
        null,
        null,
        null,
        null,
        null,
        "DE12500105170648489890",
        null,
        null,
        null
    )
    ->setDocumentSeller("Lieferant GmbH", "549910")
    ->addDocumentSellerGlobalId("4000001123452", "0088")
    ->addDocumentSellerTaxRegistration("FC", "201/113/40209")
    ->addDocumentSellerTaxRegistration("VA", "DE123456789")
    ->setDocumentSellerAddress(
        "Lieferantenstraße 20",
        "",
        "",
        "80333",
        "München",
        "DE"
    )
    ->setDocumentSellerContact(
        "Heinz Mükker",
        "Buchhaltung",
        "+49-111-2222222",
        "+49-111-3333333",
        "info@lieferant.de"
    )
    ->setDocumentBuyer("Kunden AG Mitte", "GE2020211")
    ->setDocumentBuyerReference("34676-342323")
    ->setDocumentBuyerAddress(
        "Kundenstraße 15",
        "",
        "",
        "69876",
        "Frankfurt",
        "DE"
    )
    ->addDocumentTax("S", "VAT", 275.0, 19.25, 7.0)
    ->addDocumentTax("S", "VAT", 198.0, 37.62, 19.0)
    ->setDocumentSummation(
        529.87,
        529.87,
        473.0,
        0.0,
        0.0,
        473.0,
        56.87,
        null,
        0.0
    )
    ->addDocumentPaymentTerm(
        "Zahlbar innerhalb 30 Tagen netto bis 04.04.2018, 3% Skonto innerhalb 10 Tagen bis 15.03.2018"
    )
    ->addNewPosition("1")
    ->setDocumentPositionNote("Bemerkung zu Zeile 1")
    ->setDocumentPositionProductDetails("Trennblätter A4", "", "TB100A4")
    ->setDocumentPositionGrossPrice(9.9)
    ->setDocumentPositionNetPrice(9.9)
    ->setDocumentPositionQuantity(20, "H87")
    ->addDocumentPositionTax("S", "VAT", 19)
    ->setDocumentPositionLineSummation(198.0)
    ->addNewPosition("2")
    ->setDocumentPositionNote("Bemerkung zu Zeile 2")
    ->setDocumentPositionProductDetails(
        "Joghurt Banane",
        "",
        "ARNR2",
        null,
        "0160",
        "4000050986428"
    )
    ->SetDocumentPositionGrossPrice(5.5)
    ->SetDocumentPositionNetPrice(5.5)
    ->SetDocumentPositionQuantity(50, "H87")
    ->AddDocumentPositionTax("S", "VAT", 7)
    ->SetDocumentPositionLineSummation(275.0)
    ->writeFile(dirname(__FILE__) . "/xml/factur-x.xml");
