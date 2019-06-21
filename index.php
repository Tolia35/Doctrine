<?php
require_once "bootstrap.php";

use Entity\Category;
use Entity\Project;


$projects = $entityManager->getRepository(Project::class)->findAll();



echo $twig->render("default/homepage.html.twig", [
    'projects' => $projects
]);


die;

/*
// INSERT INTO
$cat = new Category();
$cat->setLabel("Catégorie test");

$entityManager->persist($cat);
$entityManager->flush();
*/

// SELECT * FROM category
// $categories = $entityManager->getRepository(Category::class)->findAll();

// SELECT * FROM category WHERE label = 'Eau'
// $categories = $entityManager->getRepository(Category::class)->findBy(["label" => "Eau"]);
// $categories = $entityManager->getRepository(Category::class)->findByLabel("Eau");

// SELECT * FROM category ORDER BY label ASC
// $categories = $entityManager->getRepository(Category::class)->findBy([], ["label" => "ASC"]);

// SELECT * FROM category WHERE label = 'Eau' LIMIT 1
// $category = $entityManager->getRepository(Category::class)->findOneBy(["label" => "Eau"]);

/*
$category->setLabel("Eaux");

$entityManager->persist($category);
$entityManager->flush(); // UPDATE category SET label = 'Eaux' WHERE id = 1
*/

/*
$entityManager->remove($category);
$entityManager->flush(); // DELETE FROM category WHERE id = 1
*/

// SELECT COUNT(*) FROM category WHERE label = 'Eau';
// $nbCat = $entityManager->getRepository(Category::class)->count(["label" => "Eau"]);

$projects = $entityManager->getRepository(Project::class)->findMostExpensives(50000);

?>

<ul>
    <?php foreach ($projects as $project) : ?>
        <li>
            <?= $project->getTitle(); ?><br>
            <?= $project->getCategory()->getLabel(); ?><br>
            <?= $project->getDateStart()->format("d-m-Y"); ?><br>
            <?php if ($project->isFinished()): ?>
                <?= $project->getDateEnd()->format("d-m-Y"); ?><br>
            <?php endif; ?>
            <?= $project->getPrice(); ?><br>
            Durée : <?= $project->getDuration(); ?>
            <?php if (!$project->isFinished()): ?>
                (en cours...)
            <?php endif; ?>
            <br>
            <?= count($project->getMember()); ?>

            <ul>
                <?php foreach ($project->getMember() as $membre) : ?>
                    <li>
                        <?= $membre->getFullname(); ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        </li>
    <?php endforeach; ?>
</ul>


