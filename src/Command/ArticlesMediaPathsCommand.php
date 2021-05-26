<?php

namespace App\Command;

use App\Repository\ArticleMediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ArticlesMediaPathsCommand extends Command
{
    protected static $defaultName = 'articles-media:refactor-paths';

    private EntityManagerInterface $entityManager;

    private ArticleMediaRepository $articleMediaRepository;

    public function __construct(EntityManagerInterface $entityManager, ArticleMediaRepository $articleMediaRepository)
    {
        $this->entityManager = $entityManager;
        $this->articleMediaRepository = $articleMediaRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Refactor image paths db column')
            ->setHelp('Image paths will be replaced only from image name - one time run only.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $articlesMedia = $this->articleMediaRepository->findAll();

        foreach ($articlesMedia as $media) {
            $media->setName(substr($media->getName(), strrpos($media->getName(), '/') + 1));
            $this->entityManager->persist($media);
        }
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
