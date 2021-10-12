<?php

/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 13/09/17
 * Time: 17:11
 */

namespace Mini\Controller;

use Mini\Model\Categorie;
use Mini\Model\Professionnel;
use Mini\Model\Client;
use Mini\Model\Contact;

class ExcelController {

    public function index() {

        // Si $_SESSION n'existe pas (si non connecté), redirection sur la page de login
        session_start();
        if(!isset($_SESSION['connected'])) {
            header('Location: ' . URL );
        }

        // Besoin pour le menu deroulant des prestataires
        $categories = new Categorie();
        $allCategories = $categories->getAllCategories();

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/excel/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * Renvoie le nombre de lignes du fichier a generer.
     */
    public function getNbRows() {
        $cat = ($_POST['cat'] == 'all') ? '' : $_POST['cat'];
        $reg = ($_POST['reg'] == 'all') ? '' : $_POST['reg'];

        if ($cat == 'cli') {
            // Clients
            $clients = new Client();
            echo $clients->count()->nbre;
        } else {
            // Pros
            $professionnel = new Professionnel();
            echo $professionnel->count($cat, $reg)->nbre;
        }
    }

    /**
     * Genere le fichier excel.
     * Renvoie
     *      0 si erreur
     *      l'url du fichier a telecharger si ok
     */
    public function generer() {

        $clients = new Client();
        $professionnel = new Professionnel();

        $cat = ($_POST['cat'] == 'all') ? '' : $_POST['cat'];
        $reg = ($_POST['reg'] == 'all') ? '' : $_POST['reg'];

        if ($cat == 'cli') {
            // Clients
            $count = $clients->count()->nbre;
        } else {
            // Pros
            $count = $professionnel->count($cat, $reg)->nbre;
        }

        // 0 => Aucune donnee
        // 1 => Fichier genere
        if ($count != 0) {
            if ($cat == 'cli') {
                // Clients
                $clis = $clients->getAllClients();
                $contact = new Contact();
                foreach ($clis as $c) {
                    $c->contacts = $contact->getAllContacts($c->id);
                }
            //    error_log(print_r($clis, true));
                $file = $this->genExcelCli($clis, $_POST['titre']);
            } else {
                // Pros
                $file = $this->genExcelPro($professionnel->getAllProfessionnels($cat, $reg), $_POST['titre']);
            }
            echo "1 " . $file;
        } else {
            echo "0";
        }
    }

    /**
     * Genere le fichier excel pour les client.
     * @param $clis le tableau des clients
     * @param $titre le titre du document
     * @return string l'url du fichier cree
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function genExcelCli($clis, $titre) {
        session_start();
        // Creation du titre du document
        $titre = str_replace(' ', '_', str_replace(' -', '', $titre ));
        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator($_SESSION['nom'])
            ->setLastModifiedBy($_SESSION['nom'])
            ->setTitle($titre)
            ->setDescription("Garde-Infi Confort - " . $titre);
        // Premiere ligne
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nom')
            ->setCellValue('B1', 'Prenom')
            ->setCellValue('C1', 'Services')
            ->setCellValue('D1', 'Adresse')
            ->setCellValue('E1', 'Mail')
            ->setCellValue('F1', 'Téléphone')
            ->setCellValue('G1', 'Commentaire')
            ->setCellValue('H1', 'Contacts')
            ->setCellValue('H2', 'Nom')
            ->setCellValue('I2', 'Prenom')
            ->setCellValue('J2', 'Telephone')
            ->setCellValue('K2', 'Mail')
            ->setCellValue('L2', 'Commentaire');
        // Merge les cellules
        $objPHPExcel->getActiveSheet()->mergeCells("A1:A2");
        $objPHPExcel->getActiveSheet()->mergeCells("B1:B2");
        $objPHPExcel->getActiveSheet()->mergeCells("C1:C2");
        $objPHPExcel->getActiveSheet()->mergeCells("D1:D2");
        $objPHPExcel->getActiveSheet()->mergeCells("E1:E2");
        $objPHPExcel->getActiveSheet()->mergeCells("F1:F2");
        $objPHPExcel->getActiveSheet()->mergeCells("G1:G2");
        $objPHPExcel->getActiveSheet()->mergeCells("H1:L1");


        // Data
        $i = 3;
        foreach ($clis as $cli) {
            $adresse = $cli->adresse . ' ' .$cli->numero. ' /'.$cli->boite. ' '.$cli->cp.' '.$cli->ville;
            $services = '';
            foreach ($cli->services as $service) {
                if (isset($service->actif) && $service->actif) {
                    $services = $services . '  ' . $service->nom;
                }
            }
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $cli->nom)
                ->setCellValue('B' . $i, $cli->prenom)
                ->setCellValue('C' . $i, $services)
                ->setCellValue('D' . $i, $adresse)
                ->setCellValue('E' . $i, $cli->mail)
                ->setCellValue('F' . $i, $cli->telephone)
                ->setCellValue('G' . $i, $cli->commentaire);

            // Contact
            $j = -1;
            $k = $i;
            foreach($cli->contacts as $contact) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('H' . $k, $contact->nom)
                    ->setCellValue('I' . $k, $contact->prenom)
                    ->setCellValue('J' . $k, $contact->telephone)
                    ->setCellValue('K' . $k, $contact->mail)
                    ->setCellValue('L' . $k, $contact->commentaire);
                $j++;
                $k++;
            }
            // Merge si 1 < contacts
            if ($j > 0) {
                $objPHPExcel->getActiveSheet()->mergeCells("A" . $i . ":A" . ($i + $j));
                $objPHPExcel->getActiveSheet()->mergeCells("B" . $i . ":B" . ($i + $j));
                $objPHPExcel->getActiveSheet()->mergeCells("C" . $i . ":C" . ($i + $j));
                $objPHPExcel->getActiveSheet()->mergeCells("D" . $i . ":D" . ($i + $j));
                $objPHPExcel->getActiveSheet()->mergeCells("E" . $i . ":E" . ($i + $j));
                $objPHPExcel->getActiveSheet()->mergeCells("F" . $i . ":F" . ($i + $j));
                $objPHPExcel->getActiveSheet()->mergeCells("G" . $i . ":G" . ($i + $j));
                $i = $i + $j;
            }

            $i++;
        }

        // Dimentionne les colonnes
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

        // Style des lignes
        $styleHead = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 15
            ),
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:L2')->applyFromArray($styleHead);
        $styleData = array(
            'font'  => array(
                'size'  => 12
            ),
            'alignment' => array(
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A3:G' . $i)->applyFromArray($styleData);
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Save Excel 2007 file
        $callStartTime = microtime(true);
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('fichiersExcel/' . $titre . '.xlsx');
        $callEndTime = microtime(true);
        $callTime = $callEndTime - $callStartTime;
        return 'fichiersExcel/' . $titre . '.xlsx';
    }


    /**
     * Genere le fichier excel pour les pro
     * @param $pros le tableau des pro
     * @param $titre le titre du document
     * @return string l'url du fichier cree
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function genExcelPro($pros, $titre) {
        session_start();

        // Creation du titre du document
        $titre = str_replace(' ', '_', str_replace(' -', '', $titre ));

        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator($_SESSION['nom'])
            ->setLastModifiedBy($_SESSION['nom'])
            ->setTitle($titre)
            ->setDescription("Garde-Infi Confort - " . $titre);

        // Premiere ligne
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nom')
            ->setCellValue('B1', 'Prenom')
            ->setCellValue('C1', 'Profession')
            ->setCellValue('D1', 'INAMI')
            ->setCellValue('E1', 'TVA')
            ->setCellValue('F1', 'Adresse')
            ->setCellValue('G1', 'Mail')
            ->setCellValue('H1', 'Téléphone')
            ->setCellValue('I1', 'Disponibilité')
            ->setCellValue('J1', 'Commentaire');

        // Dimentionne les colonnes
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

        // Data
        $i = 2;
        foreach ($pros as $pro) {
            $reg = ($pro->regions_id == 1) ? 'BXL' : 'BW';
            $adresse = $pro->adresse . ' ' .$pro->numero. ' /'.$pro->boite. ' '.$pro->cp.' '.$pro->ville;

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $pro->nom)
                ->setCellValue('B' . $i, $pro->prenom)
                ->setCellValue('C' . $i, $pro->nom_categorie . ' - ' . $reg)
                ->setCellValue('D' . $i, $pro->inami)
                ->setCellValue('E' . $i, $pro->tva)
                ->setCellValue('F' . $i, $adresse)
                ->setCellValue('G' . $i, $pro->mail)
                ->setCellValue('H' . $i, $pro->telephone)
                ->setCellValue('I' . $i, $pro->disponibilite)
                ->setCellValue('J' . $i, $pro->commentaire);
            $i++;
        }

        // Style des lignes
        $styleHead = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 15
            ),
            'alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleHead);
        $styleData = array(
            'font'  => array(
                'size'  => 12
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A2:J' . $i)->applyFromArray($styleData);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        
        // Save Excel 2007 file
        $callStartTime = microtime(true);
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('fichiersExcel/' . $titre . '.xlsx');
        $callEndTime = microtime(true);
        $callTime = $callEndTime - $callStartTime;

        return 'fichiersExcel/' . $titre . '.xlsx';
    }

}
