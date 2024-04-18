<?php
namespace App;

use PDO;
use App\BD;
use PDOException;

class Vehicule
{

    public $id;
    public $marque;
    public $modele;
    public $description;
    public $transmission;

    public $ville;
    public $annee;
    public $carburant;
    public $km;
    public $prix;
    public $photo;
    public $proprietaire_id;

    public function __construct($id, $marque, $modele, $description, $transmission, $ville, $annee, $carburant, $km, $prix, $photo, $idProp)
    {
        $this->id = $id;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->annee = $annee;
        $this->description = $description;
        $this->transmission = $transmission;
        $this->ville = $ville;
        $this->carburant = $carburant;
        $this->km = $km;
        $this->prix = $prix;
        $this->photo = $photo;
        $this->proprietaire_id = $idProp;
    }



    public static function getCarObjToEdit($idCar, $idCarOwner)
    {
        try {
            $dbconnection = BD::getDBConnection();
            $sql = "SELECT * FROM voitures WHERE id = :idCar AND proprietaire_id = :idCarOwner";
            $statement = $dbconnection->prepare($sql);
            $statement->execute([
                'idCar' => (int) $idCar,
                'idCarOwner' => (int) $idCarOwner
            ]);
            $carToEditStd = $statement->fetch(PDO::FETCH_ASSOC);
            if ($carToEditStd) {
                return new Vehicule(
                    $carToEditStd['id'],
                    $carToEditStd['marque'],
                    $carToEditStd['modele'],
                    $carToEditStd['description'],
                    $carToEditStd['transmission'],
                    $carToEditStd['ville'],
                    $carToEditStd['annee'],
                    $carToEditStd['carburant'],
                    $carToEditStd['km'],
                    $carToEditStd['prix'],
                    $carToEditStd['photo'],
                    $carToEditStd['proprietaire_id']
                );
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors deu retour de l'objet vehicule a modifier: " . $e->getMessage());

        }
    }


    public static function addCar($car)
    {
        try {
            $dbconnection = BD::getDBConnection();
            $sql = "INSERT INTO `voitures`(`marque`, `modele`, `description`, `transmission`, `ville`, `annee`, `carburant`, `km`, `prix`, `photo`, `proprietaire_id`) VALUES (:marque, :modele, :description, :transmission, :ville, :annee, :carburant, :km, :prix, :photo, :proprietaire_id)";
            $statement = $dbconnection->prepare($sql);
            $result = $statement->execute([
                'marque' => $car['marque_add'],
                'modele' => $car['modele_add'],
                'description' => $car['description_add'],
                'transmission' => $car['transmission_add'],
                'ville' => $car['ville_add'],
                'annee' => $car['annee_add'],
                'carburant' => $car['carburant_add'],
                'km' => $car['km_add'],
                'prix' => $car['prix_add'],
                'photo' => $car['photo_add'],
                'proprietaire_id' => $car['proprietaire_id']
            ]);
            if ($result) {
                return $dbconnection->lastInsertId();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            
            Helper::logMessage("Erreur lors de l'ajout PDO d'un véhicule : " . $e->getMessage());
            return false;
        }
    }

    public static function deleteCar($carId)
    {
        try {
            $dbconnection = BD::getDBConnection();
            $sql = "DELETE FROM `voitures` WHERE `id` = :id";
            $statement = $dbconnection->prepare($sql);
            $result = $statement->execute([
                'id' => $carId
            ]);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la suppression $carId PDO d'un véhicule : " . $e->getMessage());

            return false;
        }
    }

    public static function CarEditUpdate($carTab)
    {
        try {
            $dbconnection = BD::getDBConnection();
            $sql = "UPDATE `voitures` SET `marque`= :marque, `modele`= :modele, `description`= :description, `transmission`= :transmission, `ville`= :ville, `annee`= :annee, `carburant`= :carburant, `km`= :km, `prix`= :prix, `photo`= :photo WHERE `id` = :id ";
            $statement = $dbconnection->prepare($sql);
            $result = $statement->execute([
                'marque' => $carTab['marque_mod'],
                'modele' => $carTab['modele_mod'],
                'description' => $carTab['description_mod'],
                'transmission' => $carTab['transmission_mod'],
                'ville' => $carTab['ville_mod'],
                'annee' => $carTab['annee_mod'],
                'carburant' => $carTab['carburant_mod'],
                'km' => $carTab['km_mod'],
                'prix' => $carTab['prix_mod'],
                'photo' => $carTab['photo_mod'],
                'id' => $carTab['id']
            ]);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la modification PDO d'un véhicule : " . $e->getMessage());

            return false;
        }
    }

    /**
     * getAllCars : retourne array contenant des objets de type stdClass rapp toutes les voitures
     *
     * @return array
     */
    public static function getAllCars(): array
    {
        try {
            $dbconnection = BD::getDBConnection();
            return $dbconnection->query('SELECT * FROM voitures')->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la récupération des voitures : " . $e->getMessage());
            return [];
        }
    }

    public static function getAllCarsOfUser($idPro): array
    {
        try {
            $dbconnection = BD::getDBConnection();
            return $dbconnection->query("SELECT * FROM voitures WHERE proprietaire_id = $idPro")->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la récupération des voitures de l'utilisateur $idPro: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Trie les voitures en fonction du paramètre de tri et de l'ordre spécifiés.
     *
     * @param string $sort Le champ à utiliser pour le tri (ex: "annee").
     * @param string $order L'ordre de tri ("asc" pour croissant, "desc" pour décroissant).
     * @return array Un tableau d'objets représentant les voitures triées.
     */
    public static function sortCars($sort, $order): array
    {
        try {
            $dbconnection = BD::getDBConnection();

            $order = strtolower($order) === 'desc' ? 'desc' : 'asc';

            $query = 'SELECT * FROM voitures ORDER BY ' . $sort . ' ' . $order;

            return $dbconnection->query($query)->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors du tri des voitures $sort $order: " . $e->getMessage());
            return []; 
        }
    }

    public static function getMarqueList(): array
    {
        $dbconnection = BD::getDBConnection();
        $sql = "SELECT DISTINCT `marque` FROM `voitures`";
        return $dbconnection->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public static function searchCarByBrand($marque): array
    {
        try {
            $dbconnection = BD::getDBConnection();
            $sql = "SELECT * FROM `voitures` WHERE `marque` = :marque";
            $stmt = $dbconnection->prepare($sql);
            $stmt->bindValue(':marque', $marque);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la recherche des voitures par marque $marque : " . $e->getMessage());
            return []; 
        }
    }

    public static function searchCarByTerm($searchTerm): array
    {
        try {
            $dbconnection = BD::getDBConnection();
            $sql = "SELECT * FROM voitures WHERE 
                    marque LIKE :searchTerm OR 
                    annee LIKE :searchTerm OR 
                    carburant LIKE :searchTerm OR
                    km LIKE :searchTerm OR
                    prix LIKE :searchTerm";
            $stmt = $dbconnection->prepare($sql);
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la recherche des voitures selon champ $searchTerm : " . $e->getMessage());
            return []; 
        }
    }




    /**
     * Récupère un objet Vehicule à partir de son identifiant.
     *
     * @param int $id L'identifiant du véhicule à récupérer.
     * @return Vehicule|null L'objet Vehicule correspondant à l'identifiant spécifié, ou null si aucun véhicule n'est trouvé.
     */
    public static function getSingleCarObjById($id): ?Vehicule
    {
        try {
            $dbconnection = BD::getDBConnection();
            $statement = $dbconnection->prepare("SELECT * FROM voitures WHERE id = :id");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $singleCarStd = $statement->fetch(PDO::FETCH_ASSOC);

            if ($singleCarStd) {
                return new Vehicule(
                    $singleCarStd['id'],
                    $singleCarStd['marque'],
                    $singleCarStd['modele'],
                    $singleCarStd['description'],
                    $singleCarStd['transmission'],
                    $singleCarStd['ville'],
                    $singleCarStd['annee'],
                    $singleCarStd['carburant'],
                    $singleCarStd['km'],
                    $singleCarStd['prix'],
                    $singleCarStd['photo'],
                    $singleCarStd['proprietaire_id']
                );
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la récupération du véhicule avec l'identifiant $id : " . $e->getMessage());
            return null; 
        }
    }


    /**
     * Génère une mise en page HTML représentant toutes les voitures disponibles.
     *
     * Cette méthode parcourt toutes les voitures récupérées depuis la bdd
     * et génère une mise en page HTML pour chaque voiture, incluant ses détails
     * 
     * @return string Le code HTML représentant toutes les voitures disponibles.
     */
    public static function allCarsToHtml(): string
    {
        $html = '';
        foreach (self::getAllCars() as $car) {
            $html .= <<<HTML
            <div class="col">
                <div class="card shadow-sm">
                    <img src="{$car->photo}" class="bd-placeholder-img card-img-top" width="100%" height="225" aria-label="Placeholder: Thumbnail" alt="{$car->photo}">
                    <div class="card-body">
                        <h5 class="card-title">{$car->marque} {$car->modele}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{$car->annee} - {$car->transmission} - {$car->carburant}</h6>
                        <p class="card-text">{$car->km}Km - {$car->ville}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-block">
                                    <a class="nav-link" href="vehicule_detail.php?voiture={$car->id}">Détails</a>
                                </button>
                            </div>
                            <small class="text-body-secondary fs-5"><strong>{$car->prix} €</strong></small>
                        </div>
                    </div>
                </div>
            </div>
    HTML;
        }
        return $html;
    }

    public static function allCarsSortedToHtml(array $sortCars): string
    {
        $html = '';
        foreach ($sortCars as $car) {
            $html .= <<<HTML
        <div class="col">
            <div class="card shadow-sm">
                <img src="{$car->photo}" class="bd-placeholder-img card-img-top" width="100%" height="225" aria-label="Placeholder: Thumbnail" alt="{$car->photo}">
                <div class="card-body">
                    <h5 class="card-title">{$car->marque} {$car->modele}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{$car->annee} - {$car->transmission} - {$car->carburant}</h6>
                    <p class="card-text">{$car->km}Km - {$car->ville}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-block">
                                <a class="nav-link" href="vehicule_detail.php?voiture={$car->id}">Détails</a>
                            </button>
                        </div>
                        <small class="text-body-secondary fs-5"><strong>{$car->prix} €</strong></small>
                    </div>
                </div>
            </div>
        </div>
HTML;
        }
        return $html;
    }

    public function vehiculeToHtml()
    {
        return <<<HTML
            <div class="col">
            <div class="card shadow-sm">
                <img src="{$this->photo}" class="bd-placeholder-img card-img-top" width="100%" height="225" aria-label="Placeholder: Thumbnail" alt="{$this->photo}">
                <div class="card-body">
                    <h5 class="card-title">{$this->marque} {$this->modele}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{$this->annee} - {$this->transmission} - {$this->carburant}</h6>
                    <p class="card-text">{$this->km}Km - {$this->ville} - <strong>{$this->prix} € </strong></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-block">
                                <a class="nav-link" href="vehicule_detail.php?voiture={$this->id}">Voir</a>
                            </button>
                            <button type="button" class="btn btn-sm btn-dark">
                              <a class="nav-link" href="edit.php?id={$this->id}">Modif</a>
                          </button>
                          <button type="button" class="btn btn-sm btn-danger">
                              <a class="nav-link" href="/supprimee.php?id={$this->id}">Suppr</a>
                          </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
HTML;
    }

    /**
     * singleCarToHtml : Génère le code HTML représentant une seule voiture.
     * Cette méthode récupère les informations d'une voiture spécifiée par son identifiant
     * et génère une mise en page HTML pour afficher ces informations.
     *
     * @param  int $id L'identifiant de la voiture à afficher.
     * @return string Le code HTML représentant la voiture spécifiée.
     */
    public static function singleCarToHtml(int $id): string
    {
        $singleCar = self::getSingleCarObjById($id);
        $html = '';
        $html = <<<HTML
      <div class="container my-5">
          <div class="row">
              <div class="col-md-6">
                  <img src="{$singleCar->photo}" class="img-fluid rounded" alt="Voiture">
              </div>
              <div class="col-md-6">
                  <h1 class="mb-4">{$singleCar->marque} {$singleCar->modele}</h1>
                  <p class="lead">{$singleCar->description}</p>
                  <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                          <span>Prix :</span>
                          <span class="badge bg-primary">{$singleCar->prix} €</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                          <span>Carburant :</span>
                          <span>{$singleCar->carburant}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                          <span>Transmission :</span>
                          <span>{$singleCar->transmission}</span>
                      </li>
                     
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                          <span>Année :</span>
                          <span>{$singleCar->annee}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                          <span>Kilometrage :</span>
                          <span>{$singleCar->km}</span>
                      </li> 
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                          <span>Ville :</span>
                          <span>{$singleCar->ville}</span>
                      </li>
                  </ul>
                  <form method="post" action="/checkout.php">
                      <input type="hidden" name="car_id_buy" value="{$singleCar->id}">
                      <button type="submit" class="btn btn-primary mt-3">Acheter</button>
                      <h4><strong>Achat fictif - demo - test - but non commercial</strong></h4>
                      <p>Pour tester utiliser cartes fictives de test disponibles sur stripe</p>
                  </form>
              </div>
          </div>
      </div>
HTML;
        return $html;
    }



}
