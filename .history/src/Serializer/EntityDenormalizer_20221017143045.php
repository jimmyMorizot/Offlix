<?php

namespace App\Serializer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Entity denormalizer
 */
class EntityDenormalizer implements DenormalizerInterface
{
    /** @var EntityManagerInterface **/
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        // Le manager de Doctrine
        $this->em = $em;
    }

    /**
     * Doit-on appeler la méthode denormalize() ?
     * 
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        // Le type de donnée à convertir est-il une entité Doctrine ?
        // Sa valeur est-elle de type int (donc un id...)
        return strpos($type, 'App\\Entity\\') === 0 && (is_numeric($data));
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        // Va chercher l'entité dans le Repository
        return $this->em->find($class, $data);
    }
}
