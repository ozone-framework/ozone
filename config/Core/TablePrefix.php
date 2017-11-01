<?php

namespace Core {

    use \Doctrine\ORM\Event\LoadClassMetadataEventArgs;

    class TablePrefix
    {
        protected $prefix = '';

        /**
         * TablePrefix constructor.
         * @param $prefix
         */
        public function __construct($prefix)
        {
            $this->prefix = (string)$prefix;
        }

        /**
         * @param LoadClassMetadataEventArgs $eventArgs
         */
        public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
        {
            $classMetadata = $eventArgs->getClassMetadata();

            if (!$classMetadata->isInheritanceTypeSingleTable() || $classMetadata->getName() === $classMetadata->rootEntityName) {
                $classMetadata->setPrimaryTable([
                    'name' => $this->prefix . $classMetadata->getTableName()
                ]);
            }

            foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
                if ($mapping['type'] == \Doctrine\ORM\Mapping\ClassMetadataInfo::MANY_TO_MANY && $mapping['isOwningSide']) {
                    $mappedTableName = $mapping['joinTable']['name'];
                    $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix . $mappedTableName;
                }
            }
        }

    }
}
