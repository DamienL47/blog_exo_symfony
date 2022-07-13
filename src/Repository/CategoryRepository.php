<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function add(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
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
        $queryBuilder = $this->createQueryBuilder('c');

        // j'utilise ensuite cet alias pour selectionner via mon constructeur
        // une requete sql en php dans ma table défini par mon alias
        $query = $queryBuilder->select('c')
            //je défini ma recherche (ici title) qui correspond
            // à :search
            ->where('c.title LIKE :search')
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
//     * @return Category[] Returns an array of Category objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
