<?php

namespace Maidmaid\Guidle;

class Guidle
{
    /** @var \DOMXPath */
    protected $xpath;

    public function __construct($url)
    {
        $document = new \DomDocument();
        $document->load($url);

        $this->xpath = new \DOMXpath($document);
        $this->xpath->registerNamespace('g', 'http://www.guidle.com');
    }

    public function getOffer($id)
    {
        $query = sprintf('//g:offer[@id="%s"]', $id);
        $offer = $this->xpath->query($query);

        return $offer->item(0);
    }

    public function getOffers()
    {
        $offers = $this->xpath->query('//g:offer');

        return $offers;
    }

    public function getOfferId(\DOMElement $offer)
    {
        $id = $this->xpath->query('.//@id', $offer)->item(0)->nodeValue;

        return $id;
    }

    public function getOffersByCity($cityId)
    {
        $query = sprintf('//g:offer[g:address/@cityId="%s"]', $cityId);
        $offers = $this->xpath->query($query);

        return $offers;
    }

    /**
     * @param $cityIds array
     * @return \DOMNodeList[]
     */
    public function getOffersByCities($cityIds)
    {
        $offers = array();
        foreach ($cityIds as $cityId) {
            $offers[$cityId] = $this->getOffersByCity($cityId);
        }

        return $offers;
    }

    public function getOfferDetail(\DOMElement $offer, $language = 'fr')
    {
        $query = sprintf('.//g:offerDetail[@languageCode="%s"]', $language);
        $offerDetails = $this->xpath->query($query, $offer);

        // fr by default
        if ($offerDetails->length >= 1) {
            $offerDetail = $offerDetails->item(0);
        } else {
            $offerDetail = $this->xpath->query('.//g:offerDetail[@languageCode="fr"]', $offer)->item(0);
        }

        return $offerDetail;
    }

    public function getOfferDates($offer)
    {
        return $this->xpath->query('.//g:schedules/g:date', $offer);
    }

    public function getOfferStartDate(\DOMElement $date)
    {
        $startDate = $this->xpath->query('./g:startDate', $date)->item(0)->nodeValue;
        $startTimeNode = $this->xpath->query('./g:startTime', $date)->item(0);

        return $startTimeNode
            ? trim($startDate.' '.$startTimeNode->nodeValue)
            : trim($startDate)
        ;
    }

    public function getOfferEndDate(\DOMElement $date)
    {
        $endDate = $this->xpath->query('./g:endDate', $date)->item(0)->nodeValue;
        $endTimeNode = $this->xpath->query('./g:endTime', $date)->item(0);

        return $endTimeNode
            ? trim($endDate.' '.$endTimeNode->nodeValue)
            : trim($endDate)
        ;
    }

    public function getOfferWeekdaysDate(\DOMElement $date)
    {
        $daysNodes = $this->xpath->query('./g:weekdays/g:day', $date);

        $days = array();
        foreach ($daysNodes as $node) {
            $days[] = $node->nodeValue;
        }

        return $days;
    }

    public function getOfferDetailShortDescription(\DOMElement $offerDetail, $useLongDescription = true)
    {
        $shortDescriptionNode = $this->xpath->query('.//g:shortDescription[normalize-space()]', $offerDetail)->item(0);

        if ($shortDescriptionNode === null) {
            return $useLongDescription ? $this->getOfferDetailLongDescription($offerDetail) : '';
        } else {
            return $shortDescriptionNode->nodeValue;
        }
    }

    public function getOfferDetailLongDescription(\DOMElement $offerDetail)
    {
        $longDescription = $this->xpath->query('.//g:longDescription[normalize-space()]', $offerDetail)->item(0);

        return $longDescription === null ? '' : $longDescription->nodeValue;
    }

    public function getOfferDetailTitle(\DOMElement $offerDetail)
    {
        $title = $this->xpath->query('.//g:title', $offerDetail)->item(0)->nodeValue;

        return $title;
    }

    public function getOfferTicketingContact(\DOMElement $offer)
    {
        $ticketingContact = $this->xpath->query('.//g:ticketingContact', $offer)->item(0)->nodeValue;

        return $ticketingContact;
    }

    public function getOfferPriceInformation(\DOMElement $offer)
    {
        $priceInformation = $this->xpath->query('.//g:priceInformation[normalize-space()]', $offer)->item(0)->nodeValue;

        return $priceInformation;
    }

    public function getOfferAddress(\DOMElement $offer)
    {
        $address = $this->xpath->query('.//g:address', $offer)->item(0);

        return $address;
    }

    public function getOfferAddressCompany(\DOMElement $address)
    {
        $company = $this->xpath->query('.//g:company', $address)->item(0)->nodeValue;

        return $company;
    }

    public function getOfferAddressStreet(\DOMElement $address)
    {
        $street = $this->xpath->query('.//g:street', $address)->item(0)->nodeValue;

        return $street;
    }

    public function getOfferAddressZip(\DOMElement $address)
    {
        $zip = $this->xpath->query('.//g:zip', $address)->item(0)->nodeValue;

        return $zip;
    }

    public function getOfferAddressCity(\DOMElement $address)
    {
        $city = $this->xpath->query('.//g:city', $address)->item(0)->nodeValue;

        return $city;
    }
}
