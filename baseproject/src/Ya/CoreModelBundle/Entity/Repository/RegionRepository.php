<?php

namespace Ya\CoreModelBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RegionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use Ya\CoreModelBundle\Entity\Region as Region;

class RegionRepository extends EntityRepository
{
  public function getOrCreateRegionByCountry($country, $regionCode)
  {
    $em = $this->getEntityManager();
    $region = $em->getRepository('YaCoreModelBundle:Region')->findOneBy(
      array('countryId' => $country->getId(), 'code' => $regionCode));

    if (!$region)
    {
      $region = new Region();
      $region->setCode($regionCode);
      $region->setCountry($country);
      $em->persist($region);
      $em->flush();
    }
    return $region;
  }
}
