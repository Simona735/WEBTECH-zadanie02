<?php
require_once "models/person.php";
require_once "models/ranking.php";
require_once "models/olympicGame.php";
require_once "helpers/database.php";

class PersonDBController
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }
//
//    function console_log( $data ){
//        echo '<script>';
//        echo 'console.log('. json_encode( $data ) .')';
//        echo '</script>';
//    }

    public function getAllPeople()
    {
        $stmt = $this->conn->prepare("select osoby.*, sum(u.placing = 1) as gold_count from osoby left join umiestnenia u on osoby.id = u.person_id group by osoby.id");
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_CLASS, "person");
        foreach ($people as $person) {
            $stmt = $this->conn->prepare("select umiestnenia.*, oh.city, oh.type, oh.year from umiestnenia join oh on umiestnenia.oh_id = oh.id where person_id = :personId; ");
            $stmt->bindParam(":personId", $person->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $rankings = $stmt->fetchAll(PDO::FETCH_CLASS, "ranking");
            $person->setRankings($rankings);
        }
        return $people;
    }
    public function getAllOH()
    {
        $stmt = $this->conn->prepare("select * from oh ORDER BY year DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "olympicGame");;
    }


    public function getPerson(int $id)
    {
        $stmt = $this->conn->prepare("select osoby.*, sum(u.placing = 1) as gold_count from osoby join umiestnenia u on osoby.id = u.person_id where osoby.id = :personId;");
        $stmt->bindParam(":personId", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "person");
        $person = $stmt->fetch();

        $stmt = $this->conn->prepare("select umiestnenia.*, oh.city, oh.type, oh.year from umiestnenia join oh on umiestnenia.oh_id = oh.id where person_id = :personId; ");
        $stmt->bindParam(":personId", $person->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $rankings = $stmt->fetchAll(PDO::FETCH_CLASS, "ranking");
        $person->setRankings($rankings);

        return $person;
    }

    public function insertPerson($name, $surname, $birth_day, $birth_place, $birth_country, $death_day, $death_place, $death_country)
    {
        $stmt = $this->conn->prepare("Insert into osoby (name, surname, birth_day, birth_place, birth_country, death_day, death_place, death_country) values (:name, :surname, :birth_day, :birth_place, :birth_country, :death_day, :death_place, :death_country)");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":birth_day", $birth_day, PDO::PARAM_STR);
        $stmt->bindParam(":birth_place", $birth_place, PDO::PARAM_STR);
        $stmt->bindParam(":birth_country", $birth_country, PDO::PARAM_STR);
        $stmt->bindParam(":death_day", $death_day, PDO::PARAM_STR);
        $stmt->bindParam(":death_place", $death_place, PDO::PARAM_STR);
        $stmt->bindParam(":death_country", $death_country, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function insertRanking($person_id, $oh_id, $placing, $discipline)
    {
        $stmt = $this->conn->prepare("Insert into umiestnenia (person_id, oh_id, placing, discipline ) values (:person_id, :oh_id, :placing, :discipline)");
        $stmt->bindParam(":person_id", $person_id, PDO::PARAM_INT);
        $stmt->bindParam(":oh_id", $oh_id, PDO::PARAM_INT);
        $stmt->bindParam(":placing", $placing, PDO::PARAM_INT);
        $stmt->bindParam(":discipline", $discipline, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function updatePerson(Person $person)
    {
        $stmt = $this->conn->prepare("Update osoby set name=:name, surname=:surname, death_day=:death_day, death_place=:death_place, death_country=:death_country where id = :personId");
        $name = $person->getName();
        $surname = $person->getSurname();
        $id = $person->getId();
        $death_place = $person->getDeathPlace();
        $death_country = $person->getDeathCountry();
        $death_day = $person->getDeathDay();
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":death_day", $death_day, PDO::PARAM_STR);
        $stmt->bindParam(":death_place", $death_place, PDO::PARAM_STR);
        $stmt->bindParam(":death_country", $death_country, PDO::PARAM_STR);
        $stmt->bindParam(":personId", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function deletePerson(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM umiestnenia WHERE person_id = :personId; DELETE FROM osoby WHERE id = :personId ");
        $stmt->bindParam(":personId", $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}