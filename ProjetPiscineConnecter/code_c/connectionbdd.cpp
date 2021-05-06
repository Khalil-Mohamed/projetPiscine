#include <iostream>
#include <mysql/mysql.h>
#include <sstream>
using namespace std;

const char *NomHote = "localhost";
const char *NomUtilisateur = "admin";
const char *MotDePasse = "snir2";
const char *BaseDeDonnees = "Piscine";

int main()
{
    MYSQL *connectionBDD;
    connectionBDD = mysql_init(0);
    // requete de connection a la base de données
    connectionBDD = mysql_real_connect(connectionBDD, NomHote, NomUtilisateur, MotDePasse, BaseDeDonnees, 3306, NULL, 0);
    // si la connection est reussi nous appliquons la requete d'insertion
    if (connectionBDD)
    {
        cout << "connexion a la base de données reussi" << endl;
        stringstream RequeteSQL;
        srand(time(0));
        double pH = ((double)rand()) / ((double)RAND_MAX) * 13.0 + 1.0;           // affectation d'un valeur aleatoire du pH
        double Temperature = ((double)rand()) / ((double)RAND_MAX) * 40.0 + 10.0; // affectation d'un valeur aleatoire de temperature
        double Turbidite = ((double)rand()) / ((double)RAND_MAX) * 500.0 + 10.0;
        ; // affectation d'un valeur aleatoire de turbitidé
        RequeteSQL << "INSERT INTO ValeursCapteurs(pH, Température, Turbidité) VALUES(" << pH << "," << Temperature << "," << Turbidite << ")";
        string query = RequeteSQL.str();
        const char *q = query.c_str();
        cout << q << endl; // message indiquant la requete au complet
        if (mysql_query(connectionBDD, q) == 0)
        {
            cout << "commande envoyer" << endl;
        } // Envoie de la reqquete a PHPMYADMIN
        else
        {
            cout << "erreur d'envoi" << endl;
        }
        mysql_close(connectionBDD); // Déconnexion de la base de données
    }
    // si la connexion a echoué nous ne fesons rien
    else
    {
        cout << "echec de connexion a la base de données" << endl;
        exit(1);
    }
    return (0);
}
