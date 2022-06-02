<?php

namespace App\Repository;

use App\Entity\Articulo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Articulo>
 *
 * @method Articulo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articulo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articulo[]    findAll()
 * @method Articulo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticuloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articulo::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Articulo $entity, bool $flush = false): void
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
    public function remove(Articulo $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    /**
     * @return Articulo[] Busca la cantidad de articulos indicada en base al tipo y la pagina indicada
     */
    public function findLastByType($tipo, $cantidad, $pagina): array
    {
        $primerResultado = $pagina * $cantidad - $cantidad;
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.tipo LIKE :tipo')
            ->setParameter('tipo', '%' . $tipo . '%')
            ->addOrderBy('c.id', 'DESC')
            ->setFirstResult($primerResultado)
            ->setMaxResults($cantidad)
            ->getQuery();
        return $qb->execute();
    }

    /**
     * @return int Devuelve la cantidad de paginas segun la cantidad de articulos que se muestren por pantalla
     */
    public function getMaxPages($cantidad): int
    {
        $qbF1 = $this->createQueryBuilder('c')
            ->andWhere('c.tipo LIKE :tipo')
            ->setParameter('tipo', '%' . 'f1' . '%')
            ->getQuery();
        $qbNoticia = $this->createQueryBuilder('c')
            ->andWhere('c.tipo LIKE :tipo')
            ->setParameter('tipo', '%' . 'noticia' . '%')
            ->getQuery();
        $totalF1 = count($qbF1->execute());
        $totalNoticia = count($qbNoticia->execute());
        if ($totalF1>=$totalNoticia) {
            $total = $totalF1/$cantidad;
            if($totalF1%$cantidad>0){
                $total++;
            }
            
        }else{
            $total = $totalNoticia/$cantidad;
            if($totalNoticia%$cantidad>0){
                $total++;
            }
        }
        return $total;
    }


    //    /**
    //     * @return Articulo[] Returns an array of Articulo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Articulo
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
