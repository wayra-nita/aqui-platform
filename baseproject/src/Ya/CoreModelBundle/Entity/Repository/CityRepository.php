<?php

namespace Ya\CoreModelBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

use Ya\CoreModelBundle\Entity\City as City;

class CityRepository extends EntityRepository
{
  public function getOrCreateCityByRegionAndCountry($country, $region, $cityName, $latitude, $longitude)
  {
    $em = $this->getEntityManager();
    $cities = $em->getRepository('YaCoreModelBundle:City')->findBy(
      array('country' => $country->getId(), 'region' => $region->getId(), 'name' => $cityName));
    if ($cities)
    {
      $city = $cities[0]; // Get first city. TODO: Try to find a way to get the nearest city by coordinates
    }
    else
    {
      $city = new City();
      $city->setCountry($country);
      $city->setRegion($region);
      $city->setLatitude($latitude);
      $city->setLongitude($longitude);
      $city->setName($cityName);
      $em->persist($city);
      $em->flush();
    }
    return $city;
  }
}
