<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function add(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //je créé une instance de classe pour récupérer les parametre de ma recherche
    public function searchByWord($search)
    {
        //Je créé un constructeur (queryBuilder) et lui défini un alias
        $queryBuilder = $this->createQueryBuilder('a');

        // j'utilise ensuite cet alias pour selectionner via mon constructeur
        // une requete sql en php dans ma table défini par mon alias
        $query = $queryBuilder->select('a')
            //je défini ma recherche (ici title) qui correspond
            // à :search
            ->where('a.title LIKE :search')
            //je défini les parametre de :search en passant search en key et lui
            // donne une value contenant des caractère avant et après pour sécuriser la variable
            // et permet de rechercher les articles contenant le mots passé en key
            ->setParameter('search', '%'.$search.'%')
            //je récupère grace au guetter la requete correspondante
            ->getQuery();
        //puis je retourne ses valeurs depuis la base de données
        return $query->getResult();
    }

//    /**
//     * @return Post[] Returns an array of Post objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
