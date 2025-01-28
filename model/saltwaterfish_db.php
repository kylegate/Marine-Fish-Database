<?php
class saltwaterfishDB {
public static function SearchSaltwaterFish($scientific_name, $common_name, $lifespan, $behavior, $saltwater_fish_ID, $start=0, $limit=10)
    {
        $_DB = new DB();
        $parameters = []; 
        $conditions = [];

        if (!empty($scientific_name)) {
            $conditions[] = "lcase(ScientificName) LIKE ?";
            $parameters[] = "%" . strtolower($scientific_name) . "%";
        }
        if (!empty($common_name)) {
            $conditions[] = "lcase(CommonName) LIKE ?";
            $parameters[] = "%" . strtolower($common_name) . "%";
        }
        if (!empty($lifespan)) {
            $conditions[] = "Lifespan = ?";
            $parameters[] = $lifespan;
        }
        if (!empty($behavior)) {
            $conditions[] = "lcase(Behavior) LIKE ?";
            $parameters[] = "%" . strtolower($behavior) . "%";
        }
        if (!empty($saltwater_fish_ID)) {
            $conditions[] = "SaltwaterFishID = ?";
            $parameters[] = $saltwater_fish_ID;
        }

        $whereClause = "";
        if (!empty($conditions)) {
            $whereClause = " WHERE " . implode(" AND ", $conditions);
        }

            ### Find Num Results ### 
        if ($start ==0) 
        {
            // (B) SEARCH FOR USERS
            $query = "SELECT count(*) as num "
            . "FROM `webb_saltwaterfish` "
            . $whereClause 
            ;
            $results = $_DB->returnOne($query, $parameters);

            if ($results != null)
            {
                $_SESSION["NumResults"] = $results['num'];
            }
            else {
                $_SESSION["NumResults"] = 0; // Handle case where no results are found
            }
        }

        $query = "SELECT * "
             . " FROM `webb_saltwaterfish` "
             . $whereClause
             . " ORDER BY SaltwaterFishID "
             . " LIMIT $limit OFFSET $start";

        $rows = $_DB->select($query, $parameters);
        unset($_DB);
        
        $fishes = [];
        foreach ($rows as $row) {
            $fish = new saltwaterfish($row['ScientificName'],
                                $row['CommonName'],
                                $row['Lifespan'],
                                $row['Behavior']);
            $fish->setsaltwaterFishID($row['SaltwaterFishID']);
            $fishes[] = $fish;
        }
        return $fishes;
    }
    
    public static function getSaltwaterFish($SaltwaterFishID) {
        $_DB = new DB();    
        $query = 'SELECT * FROM `webb_saltwaterfish` '
            . 'WHERE SaltwaterFishID = ? ';
        $rows = $_DB->select($query,[$SaltwaterFishID]);
        unset($_DB);
        $fishes = [];
        foreach ($rows as $row) {
            $fish = new saltwaterfish($row['ScientificName'],
                                $row['CommonName'],
                                $row['Lifespan'],
                                $row['Behavior']);
            $fish->setsaltwaterFishID($row['SaltwaterFishID']);
            $fishes[] = $fish;
        }
        return $fishes[0];
    }

    public static function addSaltwaterFish($SaltwaterFish) {
        $_DB = new DB();
        $query = 'INSERT INTO `webb_saltwaterfish` ' .
                '  (ScientificName, CommonName, Behavior, Lifespan) ' .
                '  VALUES (?, ?, ?, ?)';
        try {
            $_DB->execute($query, [
                $SaltwaterFish->getScientific_Name(),
                $SaltwaterFish->getCommon_Name(),
                $SaltwaterFish->getBehavior(),
                $SaltwaterFish->getLifespan()
            ]);

            $query = "SELECT * FROM `webb_saltwaterfish` " .
                     "WHERE lcase(ScientificName) LIKE ? " .
                     "AND lcase(CommonName) LIKE ? " .
                     "AND Lifespan = ? " .
                     "AND lcase(Behavior) LIKE ? " .
                     "ORDER BY SaltwaterFishID DESC LIMIT 1";

            $rows = $_DB->select($query, [
                strtolower($SaltwaterFish->getScientific_Name()),
                strtolower($SaltwaterFish->getCommon_Name()),
                $SaltwaterFish->getLifespan(),
                strtolower($SaltwaterFish->getBehavior())
            ]);
            
            unset($_DB);
            
            foreach ($rows as $row) {
                $SaltwaterFishID = $row['SaltwaterFishID'];
            }

            return $SaltwaterFishID;
        } catch (PDOException $e) {
            Database::displayError($e->getMessage());
        }
    }

    public static function updateSaltwaterFish($SaltwaterFish) {
        $_DB = new DB(); 

        $query = 'UPDATE `webb_saltwaterfish` ' .
                 'SET ScientificName = ?, CommonName = ?, Behavior = ?, Lifespan = ? ' .
                 'WHERE SaltwaterFishID = ?';
        try {
            $NumResults = $_DB->execute($query,
                    [
                        $SaltwaterFish->getScientific_Name(),
                        $SaltwaterFish->getCommon_Name(),
                        $SaltwaterFish->getBehavior(),
                        $SaltwaterFish->getLifespan(),
                        $SaltwaterFish->getSaltwaterFishID()],);
            unset($_DB);
            return $NumResults;
        } catch (PDOException $e) {
            Database::displayError($e->getMessage());
        }
    }

    public static function deleteSaltwaterFish($SaltwaterFishID) {
        $_DB = new DB();
        $query = 'DELETE FROM `webb_saltwaterfish`WHERE SaltwaterFishID = ?';
        
        try {
            $NumResults = $_DB->execute($query, [$SaltwaterFishID],);
            unset($_DB);
            return $NumResults;
        } catch (PDOException $e) {
            Database::displayError($e->getMessage());
        }
    }
}