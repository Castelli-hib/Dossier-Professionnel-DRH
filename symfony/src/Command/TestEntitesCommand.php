<?php

namespace App\Command;

use App\Entity\Agent;
use App\Entity\Document;
use App\Entity\Service;
use App\Entity\LogConsultation;
use App\Entity\CategorieDocument;
use App\Enum\TypeDocument;
use App\Enum\StatutActualite;
use App\Enum\Direction;
use App\Enum\Pole;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:test-entites',
    description: 'Test des entités',
)]
class TestEntitesCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('TEST ENTITÉS DRH');

        // ================= DIRECTION (ENUM) =================
        $direction = \App\Enum\Direction::RH;

        // SERVICE
        $service = $this->em->getRepository(Service::class)
            ->findOneBy(['nom' => 'Ressources Humaines']);

        if (!$service) {
            $service = (new Service())
                ->setNom('Ressources Humaines')
                ->setDirection(\App\Enum\Direction::RH);

            $this->em->persist($service);
        }

        // AGENT
        $agent = $this->em->getRepository(Agent::class)
            ->findOneBy(['email' => 'test@test.fr']);

        if (!$agent) {
            $agent = (new Agent())
                ->setNom('Test')
                ->setPrenom('Marie')
                ->setEmail('test@test.fr')
                ->setPoste('Gestionnaire RH')
                ->setService($service)
                ->setPole(\App\Enum\Pole::ADMIN);

            $this->em->persist($agent);
        }

        // ================= CATEGORIE =================
        $categorie = (new CategorieDocument())
            ->setNom('RH');

        $this->em->persist($categorie);

        // ================= DOCUMENT =================
        $doc = (new Document())
            ->setTitre('Contrat de travail')
            ->setType(\App\Enum\TypeDocument::PDF)
            ->setCategorie($categorie)
            ->setAgent($agent);

        $this->em->persist($doc);

        $this->em->flush();

        // ================= LOG =================
        $log = (new LogConsultation())
            ->setUtilisateur($agent)
            ->setDocument($doc)
            ->setIdRessource($doc->getId())
            ->setAction('consultation')
            ->setOrigine('test');

        $this->em->persist($log);
        $this->em->flush();

        $output->writeln('✔ TEST ENTITÉS OK');

        return Command::SUCCESS;
    }
}
