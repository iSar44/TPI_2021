<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');
require_once('./src/controllers/config/mailparam.php');


$transport = (new Swift_SmtpTransport(EMAIL_SERVER, EMAIL_PORT, EMAIL_TRANS))
    ->setUsername(EMAIL_USERNAME)
    ->setPassword(EMAIL_PASSWORD);

$mailer = new Swift_Mailer($transport);


/**
 * Fonction qui envoie des emails quand le tournoi commence
 *
 * @param Equipe_tM $ownTeam
 * @param Equipe_tM $adversaryTeam
 * @param Tournoi_tM $unTournoi
 * @param Swift_Mailer $aMailer
 * @return void
 */
function sendMailToPlayersStartTournament(Equipe_tM $ownTeam, Equipe_tM $adversaryTeam, Tournoi_tM $unTournoi, $aMailer)
{
    $dateTournoiStart = $unTournoi->getDateHeureDemarrage();
    $stringDate = strtotime((string)$dateTournoiStart);

    $ownTeamName = $ownTeam->getNomEquipe();
    $ownTeamEmail = $ownTeam->getEmail();

    $adversaryTeamName = $adversaryTeam->getNomEquipe();

    $titreTournoi = $unTournoi->getTitre();
    $dateMatch = date("d/m/Y H:i:s", $stringDate);

    $text = "<h2>Bienvenue au tournoi '" . $titreTournoi . "'</h2><br/>
    <p>Le premier match opposera votre équipe <i><b>" . $ownTeamName . '</b></i> contre  <i><b>' . $adversaryTeamName . "</b></i></p>
    La date et l'heure du premier match: <b>" . $dateMatch . "</b>";

    $message = (new Swift_Message("Début du tournoi"))
        ->setFrom([EMAIL_USERNAME => "tManager - Info"])
        ->setTo([$ownTeamEmail => $ownTeamName])
        ->setBody($text, 'text/html');

    $aMailer->send($message);
}


/**
 * Fonction qui envoie des emails à la fin de chaque ronde
 *
 * @param Tournoi_tM $unTournoi
 * @param Swift_Mailer $aMailer
 * @return void
 */
function sendMailToPlayersEndRound(Tournoi_tM $unTournoi, $aMailer)
{
    $t_controller = new Tournoi_tM_Controller();

    $titreTournoi = $unTournoi->getTitre();

    $rounds = $t_controller->GetTournamentRounds($unTournoi);
    $latestRound = end($rounds);
    $level = $latestRound->getLevel();

    $teams = $t_controller->GetTournamentTeams($unTournoi);

    foreach ($teams as $aTeam) {

        $teamName = $aTeam->getNomEquipe();
        $email = $aTeam->getEmail();
        $res = $t_controller->GetGlobalResultsOfTeam($unTournoi, $aTeam);

        if ($res == 3) {

            $text = "<h2>Résultat pour la ronde n°" . $level . "</h2>
            <br/><p>Votre équipe <b><i>" . $teamName . "</i></b> est qualifiée car elle a cumulé " . $res . " points! <b>Bravo!</b></p>";

            $message = (new Swift_Message("Résultat Final - Tournoi: " . $titreTournoi))
                ->setFrom([EMAIL_USERNAME => "tManager - Info"])
                ->setTo([$email => $teamName])
                ->setBody($text, 'text/html');
        } else {
            $text = "<h2>Résultat pour la ronde n°" . $level . "</h2>
            <br/><p>Votre équipe <b><i>" . $teamName . "</i></b> a cumulé " . $res . " point(s)!</p>";

            $message = (new Swift_Message("Résultat Intermédiaire - Tournoi: " . $titreTournoi))
                ->setFrom([EMAIL_USERNAME => "tManager - Info"])
                ->setTo([$email => $teamName])
                ->setBody($text, 'text/html');
        }


        $aMailer->send($message);
    }
}


/**
 * Fonction qui envoie des emails à la fin d'un tournoi
 *
 * @param Tournoi_tM $unTournoi
 * @param Swift_Mailer $aMailer
 * @return void
 */
function sendMailTournamentEnded(Tournoi_tM $unTournoi, $aMailer)
{
    $t_controller = new Tournoi_tM_Controller();

    $rounds = $t_controller->GetTournamentRounds($unTournoi);
    $teams = $t_controller->GetTournamentTeams($unTournoi);

    $res = $t_controller->GetResultsFromTournament($unTournoi);
    $output = serialize($res);

    foreach ($teams as $aTeam) {

        $teamName = $aTeam->getNomEquipe();
        $email = $aTeam->getEmail();


        $text = "<h2>Résultat des matchs du tournoi</h2><br/>
        <p>Les résultats du tournoi sont: " . $output . "</p>";

        $message = (new Swift_Message("Tournoi Terminé"))
            ->setFrom([EMAIL_USERNAME => "tManager - Info"])
            ->setTo([$email => $teamName])
            ->setBody($text, 'text/html');

        $aMailer->send($message);
    }
}
