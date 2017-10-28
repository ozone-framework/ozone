<?php

namespace App\Main\Repositories {

    use Acme\AbstractResource;
    use App\Example\Entity\Example;

    class ExampleRepository extends AbstractResource
    {

        /**
         * @return array
         */
        public function findAll()
        {
            $banners = $this->em->getRepository(Example::class)->findAll();
            $banners = array_map(
                function ($photo) {
                    return $photo->getArrayCopy();
                },
                $banners
            );

            return $banners;
        }

        /**
         * @param null $slug
         * @return mixed
         */
        public function find($slug = null)
        {
            $banner = $this->em->getRepository(Example::class)->findOneBy(
                array('slug' => $slug)
            );
            if ($banner) {
                return $banner->getArrayCopy();
            }
        }
    }
}
