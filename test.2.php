<?php

# composer
require __DIR__ . "/vendor/autoload.php";

# imports
use horstoeko\zugferd\ZugferdDocumentBuilder;
use horstoeko\zugferd\ZugferdProfiles;

# create a new document
$document = ZugferdDocumentBuilder::createNew(
    ZugferdProfiles::PROFILE_XRECHNUNG_3
);

# general document information
$document->setDocumentInformation(
    "471102",
    "380",
    \DateTime::createFromFormat("Ymd", "20240610"),
    "EUR"
);

# trade parties: seller & buyer
$document->setDocumentSeller("Lieferant GmbH", "549910");
$document->addDocumentSellerGlobalId("4000001123452", "0088");
$document->addDocumentSellerTaxRegistration("FC", "201/113/40209");
$document->addDocumentSellerTaxRegistration("VA", "DE123456789");
$document->setDocumentSellerAddress(
    "Lieferantenstraße 20",
    "",
    "",
    "80333",
    "München",
    "DE"
);
$document->setDocumentSellerContact(
    "Heinz Müller",
    "Buchhaltung",
    "+49-111-2222222",
    "+49-111-3333333",
    "info@lieferant.de"
);

$document->setDocumentBuyer("Kunden AG Mitte", "GE2020211");
$document->setDocumentBuyerReference("34676-342323");
$document->setDocumentBuyerAddress(
    "Kundenstraße 15",
    "",
    "",
    "69876",
    "Frankfurt",
    "DE"
);

# document totals
$document->setDocumentSummation(
    529.87,
    529.87,
    473.0,
    0.0,
    0.0,
    473.0,
    56.87,
    null,
    0.0
);

# VAT
$document->addDocumentTax("S", "VAT", 275.0, 19.25, 7.0);
$document->addDocumentTax("S", "VAT", 198.0, 37.62, 19.0);

# genrate XML

$document->writeFile(dirname(__FILE__) . "/xml/factur-x-2.xml");
