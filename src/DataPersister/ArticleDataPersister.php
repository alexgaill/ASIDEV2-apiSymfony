<?php
namespace App\DataPersister;

use App\Entity\Article;
use App\Repository\CategorieRepository;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class ArticleDataPersister implements ContextAwareDataPersisterInterface {

    public function __construct(ContextAwareDataPersisterInterface $decorated, CategorieRepository $catRepo)
    {
        $this->decorated = $decorated;
        $this->catRepo = $catRepo;
    }
    public function supports($data, array $context= []): bool
    {
        return $data instanceof Article;
    }

    public function persist($data, array $context = [])
    {
        $categorie = $this->catRepo->find(1);
        $data->setCreatedAt(new \DateTime());
        $data->setCategorie($categorie);
        $this->decorated->persist($data, $context);
        return $data;
    }

    public function remove($data, array $context = [])
    {
        
    }
}