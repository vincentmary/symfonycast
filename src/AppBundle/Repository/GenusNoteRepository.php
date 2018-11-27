<?php
/**
 * Created by PhpStorm.
 * User: vmary
 * Date: 27/11/2018
 * Time: 12:11
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\GenusNote;
use AppBundle\Entity\Genus;

class GenusNoteRepository extends EntityRepository
{
    /**
     * @return GenusNote[]
     */
    public function findAllRecentNotesForGenus(Genus $genus) {
        return $this->createQueryBuilder('genus_note')
            ->andWhere('genus_note.genus = :genus')
            ->setParameter('genus', $genus)
            ->andWhere('genus_note.createdAt > :recentDate')
            ->setParameter('recentDate', new \DateTime('-3 months'))
            ->orderBy('genus_note.createdAt', 'DESC')
            ->getQuery()
            ->execute();
    }

}