<?php

namespace App\Repository;

use App\Entity\Oferta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Oferta>
 *
 * @method Oferta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oferta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oferta[]    findAll()
 * @method Oferta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfertaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oferta::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Oferta $entity, bool $flush = false): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Oferta $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    /**
     * @return Oferta[] Devuelve las ofertas filtradas con los parametros indicados
     */
    public function findByFilters($precioMin, $precioMax, $potMin, $potMax, $kmMin, $kmMax, $plazas, $puertas,$cambio,$combustible): array
    {
        $qb = $this->createQueryBuilder('c');

        if($precioMin!=null){
            $qb->andWhere('c.precio >= :precioMin')
            ->setParameter('precioMin',  $precioMin);
        }
        if($precioMax!=null){
            $qb->andWhere('c.precio <= :precioMax')
            ->setParameter('precioMax',  $precioMax);
        } 
        if($potMax!=null){
            $qb->andWhere('c.cv <= :potMax')
            ->setParameter('potMax',  $potMax);
        } 
        if($potMin!=null){
            $qb->andWhere('c.cv >= :potMin')
            ->setParameter('potMin',  $potMin);
        } 
        if($kmMax!=null){
            $qb->andWhere('c.km <= :kmMax')
            ->setParameter('kmMax',  $kmMax);
        } 
        if($kmMin!=null){
            $qb->andWhere('c.km >= :kmMin')
            ->setParameter('kmMin',  $kmMin);
        } 
        if($plazas!=null){
            $qb->andWhere('c.plazas = :plazas')
            ->setParameter('plazas',  $plazas);
        } 
        if($puertas!=null){
            $qb->andWhere('c.puertas = :puertas')
            ->setParameter('puertas',  $puertas);
        } 
        if($cambio!=null){
            $qb->andWhere('c.cambio = :cambio')
            ->setParameter('cambio',  $cambio);
        } 
        if($combustible!=null){
            $qb->andWhere('c.combustible = :combustible')
            ->setParameter('combustible',  $combustible);
        } 
        return $qb->getQuery()->execute();
    }
    /**
    * @return Oferta[] Returns an array of Oferta objects
    */
   public function findByUser($user): array
   {
       return $this->createQueryBuilder('o')
           ->andWhere('o.usuario = :val')
           ->setParameter('val', $user)
           ->orderBy('o.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }


//    /**
//     * @return Oferta[] Returns an array of Oferta objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Oferta
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
