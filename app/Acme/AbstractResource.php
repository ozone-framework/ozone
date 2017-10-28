<?php

namespace Acme {

    use Doctrine\ORM\EntityManager;

    abstract class AbstractResource
    {
        /**
         * @var \Doctrine\ORM\EntityManager
         */
        protected $em = null;

        /**
         * AbstractResource constructor.
         * @param EntityManager $em
         */
        public function __construct(EntityManager $em)
        {
            $this->em = $em;
        }
    }
}