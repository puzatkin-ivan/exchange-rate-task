<?php

namespace App\Repository;

use App\Entity\Rate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rate[]    findAll()
 * @method Rate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rate::class);
    }

    /**
     * @param $from
     * @param $to
     * @param $date
     * @return Rate|null
     */
    public function getRate($from, $to, $date): ?Rate
    {
        $params = [
            'from_currency' => $from,
            'to_currency' => $to,
            'date' => new \DateTime($date),
        ];

        return $this->findOneBy($params);
    }

    public function addFromArray(array $params): Rate
    {
        $rate = new Rate();
        $rate->setFromCurrency($params['from']);
        $rate->setToCurrency($params['to']);
        $rate->setDate(new \DateTime($params['date']));
        $rate->setRate($params['rate']);

        $em = $this->getEntityManager();
        $em->persist($rate);
        $em->flush();

        return $rate;
    }
}
