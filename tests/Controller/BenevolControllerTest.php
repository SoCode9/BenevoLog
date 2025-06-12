<?php

namespace App\Test\Controller;

use App\Entity\Benevol;
use App\Repository\BenevolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BenevolControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private BenevolRepository $repository;
    private string $path = '/benevol/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Benevol::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Benevol index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'benevol[first_name]' => 'Testing',
            'benevol[last_name]' => 'Testing',
            'benevol[gender]' => 'Testing',
            'benevol[birth_date]' => 'Testing',
            'benevol[email]' => 'Testing',
            'benevol[address]' => 'Testing',
            'benevol[private_phone]' => 'Testing',
        ]);

        self::assertResponseRedirects('/benevol/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Benevol();
        $fixture->setFirst_name('My Title');
        $fixture->setLast_name('My Title');
        $fixture->setGender('My Title');
        $fixture->setBirth_date('My Title');
        $fixture->setEmail('My Title');
        $fixture->setAddress('My Title');
        $fixture->setPrivate_phone('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Benevol');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Benevol();
        $fixture->setFirst_name('My Title');
        $fixture->setLast_name('My Title');
        $fixture->setGender('My Title');
        $fixture->setBirth_date('My Title');
        $fixture->setEmail('My Title');
        $fixture->setAddress('My Title');
        $fixture->setPrivate_phone('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'benevol[first_name]' => 'Something New',
            'benevol[last_name]' => 'Something New',
            'benevol[gender]' => 'Something New',
            'benevol[birth_date]' => 'Something New',
            'benevol[email]' => 'Something New',
            'benevol[address]' => 'Something New',
            'benevol[private_phone]' => 'Something New',
        ]);

        self::assertResponseRedirects('/benevol/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getFirst_name());
        self::assertSame('Something New', $fixture[0]->getLast_name());
        self::assertSame('Something New', $fixture[0]->getGender());
        self::assertSame('Something New', $fixture[0]->getBirth_date());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getPrivate_phone());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Benevol();
        $fixture->setFirst_name('My Title');
        $fixture->setLast_name('My Title');
        $fixture->setGender('My Title');
        $fixture->setBirth_date('My Title');
        $fixture->setEmail('My Title');
        $fixture->setAddress('My Title');
        $fixture->setPrivate_phone('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/benevol/');
    }
}
