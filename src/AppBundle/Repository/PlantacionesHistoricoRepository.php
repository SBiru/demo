<?php
namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * ArticlesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlantacionesHistoricoRepository extends EntityRepository
{
  public function findPlantacionNuevaWithArea($id)
  {
      $em = $this->getEntityManager();
      $dql = "SELECT p as plantacionAnterior, ST_AREA(p.geom)/10000 as area
              FROM AppBundle:PlantacionesHistorico ph
              left join AppBundle:Plantaciones p WITH ph.plantacionAnterior = p.id
              where ph.plantacionNueva = :id";
      $query = $em->createQuery($dql);
      $query->setParameter('id', $id);
      $plantaciones = $query->getResult();
      return $plantaciones;
  }
  public function findPlantacionAnteriorWithArea($id)
  {
      $em = $this->getEntityManager();
      $dql = "SELECT p as plantacionNueva, ST_AREA(p.geom)/10000 as area
              FROM AppBundle:PlantacionesHistorico ph
              left join AppBundle:Plantaciones p WITH ph.plantacionNueva = p.id
              where ph.plantacionAnterior = :id";
      $query = $em->createQuery($dql);
      $query->setParameter('id', $id);
      $plantaciones = $query->getResult();
      return $plantaciones;
  }
}