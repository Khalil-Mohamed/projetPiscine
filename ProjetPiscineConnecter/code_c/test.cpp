#include <iostream>
#include <linux/i2c-dev.h>
#include <sys/ioctl.h>
#include <fcntl.h>
#include <fstream>
#include <unistd.h>
#include <mysql/mysql.h>
#include <sstream>
using namespace std;

const char *NomHote = "localhost";
const char *NomUtilisateur = "admin";
const char *MotDePasse = "snir2";
const char *BaseDeDonnees = "Piscine";

int main()
{
    // Creation du bus I2C
    int cable;
    int DigitalpH, DigitalTemp, DigitalTurb;
    float VoltpH, VoltTemp, VoltTurb, pH, Temp, NTU;
    const char *bus = "/dev/i2c-1";
    if ((cable = open(bus, O_RDWR)) < 0) // test de la connexion I2C
    {
        printf("echec de connexion au bus.\n");
        exit(1);
    }
    printf("connexion au bus réussi.\n");
    ioctl(cable, I2C_SLAVE, 0x48); // affectaton de l'adresse I2C de l'ADS1115 au GND (0x48(72))
    char configA0[3] = {0};        // variable contenant la configuration de la sortie A0
    configA0[0] = 0x01;            // Mode configuration (00000001)
    configA0[1] = 0xC2;            // gain = 4.096V, AINP = AIN0 et AINN = GND, conversion mode continue (11000010)
    configA0[2] = 0x83;            // SPS = 128 (10000011)
    write(cable, configA0, 3);     // ecriture de la configuration
    sleep(1);

    // lecture des 2 octets de données de la sortie A0
    // octet de poids, octet de poids faible

    char LectureA0[1] = {0x00};        // mode lecture de la sortie A0 (00000000)
    write(cable, LectureA0, 1);        // ecriture du mode lecture
    char donnespH[2] = {0};            // variable contenant les données lu
    if (read(cable, donnespH, 2) != 2) // lecture et verification si la connexion est effectuer avec la sortie A0
    {
        printf("Erreur d'entrée/sortie \n");
    }
    else
    {
        DigitalpH = (donnespH[0] * 256 + donnespH[1]); // conversion des valeurs analogiques en valeur numeriques
        if (DigitalpH > 32767)
        {
            DigitalpH -= 65535;
        }
        VoltpH = (float)DigitalpH * 4.096 / 32767.0;   // verification de la tension reçue
        pH = 7 + ((1.637 - VoltpH) / 0.1839);          // conversion en unité de pH
        printf("Valeur numerique : %d \n", DigitalpH); // affichage des données recue en decimal
        printf("courants : %0.3f \n", VoltpH);         // affichage du courants
        printf("pH : %0.2f \n", pH);                   // affichage du pH
    }

    // configuration sortie A1, le principe est le meme que pour A0

    char configA1[3] = {0};
    configA1[0] = 0x01;
    configA1[1] = 0xD2; // gain = 4.096V, AINP = AIN1 et AINN = GND, conversion mode continue (11010010)
    configA1[2] = 0x83;
    write(cable, configA1, 3);
    sleep(1);

    // lecture sortie A1 meme principe que A0

    char LectureA1[1] = {0x00};
    write(cable, LectureA1, 1);
    char donnesTemp[2] = {0};
    if (read(cable, donnesTemp, 2) != 2)
    {
        printf("Erreur d'entrée/sortie \n");
    }
    else
    {
        DigitalTemp = (donnesTemp[0] * 256 + donnesTemp[1]);
        if (DigitalTemp > 32767)
        {
            DigitalTemp -= 65535;
        }

        // affichage de la valeur numérique
        VoltTemp = (float)DigitalTemp * 4.096 / 32767.0;
        Temp = DigitalTemp / 1000; // conversion en C°
        printf("Valeur numerique : %d \n", DigitalTemp);
        printf("courants: %0.3f \n", VoltTemp);
        printf("température: %0.2f \n", Temp);
    }

    // configuration sortie A2

    char configA2[3] = {0};
    configA2[0] = 0x01;
    configA2[1] = 0xE2; // gain = 4.096V, AINP = AIN2 et AINN = GND, conversion mode continue (11100010)
    configA2[2] = 0x83;
    write(cable, configA2, 3);
    sleep(1);

    // Lecture A2

    char LectureA2[1] = {0x00};
    write(cable, LectureA2, 1);
    char donnesTurb[2] = {0};
    if (read(cable, donnesTurb, 2) != 2)
    {
        printf("Erreur d'entrée/sortie \n");
    }
    else
    {
        DigitalTurb = (donnesTurb[0] * 256 + donnesTurb[1]);
        if (DigitalTurb > 32767)
        {
            DigitalTurb -= 65535;
        }
        VoltTurb = (float)DigitalTurb * 4.096 / 32767.0;
        if (VoltTurb < 2.5) // verification si courants inferieur a 2.5V
        {
            NTU = 3000; // eau tres tres trouble
        }
        else
        {
            NTU = -1120.4 * (VoltTurb * VoltTurb) + 5742.3 * VoltTurb - 4353.8; // conversion en NTU
        }
        printf("Valeur numerique: %d \n", DigitalTurb);
        printf("courants: %0.3f \n", VoltTurb);
        printf("NTU: %0.2f \n", NTU);
    }
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
        RequeteSQL << "INSERT INTO ValeursCapteurs(pH, Température, Turbidité) VALUES(" << pH << "," << Temp << "," << NTU << ")";
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