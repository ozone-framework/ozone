<?php

namespace App\Example\Repositories {

    use Core\AbstractResource;
    use App\Example\Entity\Example;

    class ExampleRepository extends AbstractResource
    {

        /**
         * @return array
         */
        public function findAll()
        {
            $examples = $this->em->getRepository(Example::class)->findAll();
            $examples = array_map(
                function ($examples) {
                    return $examples->getArrayCopy();
                },
                $examples
            );

            return $examples;
        }

        /**
         * @param null $slug
         * @return mixed
         */
        public function find($slug = null)
        {
            $example = $this->em->getRepository(Example::class)->findOneBy(
                array('slug' => $slug)
            );
            if ($example) {
                return $example->getArrayCopy();
            }
        }
    }
}
