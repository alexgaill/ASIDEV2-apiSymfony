<?php
namespace App\Controller;

use App\Entity\Article;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ArticleController extends AbstractController {

    private $manager;

    public function __construct(ManagerRegistry $manager, CategorieRepository $catRepo)
    {
        $this->manager = $manager->getManager();
        $this->catRepo = $catRepo;
    }

    public function __invoke (Article $data): Article
    {
        $categorie = $this->catRepo->find(1);
        $data->setCreatedAt(new \DateTime());
        $data->setCategorie($categorie);

        $this->manager->persist($data);
        $this->manager->flush();

        return $data;
    }
}