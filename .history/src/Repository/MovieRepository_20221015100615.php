<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function add(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupère mes films par ordre alphabétique en bdd
     * 
     * @return Movie[]
     */
    public function findAllOrderByTitleSearch($needle = null): array
       {
           return $this->createQueryBuilder('m')
                ->orderBy('m.title')
                ->where('m.title LIKE :needle')
                ->setParameter(':needle',"%".$needle."%")
                ->getQuery()
                ->getResult()
           ;
       } 
    /**
     * Récupère mes films du plus récent au plus ancien
     * 
     * @return Movie[]
     */
    public function findAllOrderByReleaseDate(): array
       {
           return $this->createQueryBuilder('m')
                ->orderBy('m.release_date','DESC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
           ;
       } 

    public function findOneB   

        /**
         * Retunrs tous les films par page
         *
         * @return void
         */
        /* public function getPaginatedMovies($page, $limit) {

            return $this->createQueryBuilder('m')
                //->where('m.id = 181')
                ->setFirstResult(($page * $limit) - $limit)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult();
        }    */

        

//    /**
//     * @return Movie[] Returns an array of Movie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//             équivaut à :
            // SELECT * FROM MOVIE as m

//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Movie
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
