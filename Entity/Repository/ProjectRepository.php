<?php


namespace Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Entity\Project;

class ProjectRepository extends EntityRepository
{

    /**
     * @return Project[]
     */
    public function findWithCategory(): array
    {
        $qb = $this->createQueryBuilder("project");

        $qb->select("project", "category")
            ->innerJoin("project.category", "category");

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Project[]
     */
    public function findLast(int $limit = 3): array
    {
        $qb = $this->createQueryBuilder("project");

        $qb->select("project", "category")
            ->innerJoin("project.category", "category")
            ->orderBy("project.dateStart", "DESC")
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Project[]
     */
    public function findMostExpensives(float $price): array
    {
        $qb = $this->createQueryBuilder("project");

        $qb->select("project", "category")
            ->innerJoin("project.category", "category")
            ->where("project.price > :price");

        $qb->setParameter("price", $price);

        return $qb->getQuery()->getResult();
    }
}