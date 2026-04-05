Esiteks paigaldasin virtualboxi linuxi masinas apache2, mariadb, php/phpmyadmin.
Apache2 hoiab veebi üleval.
Mariadb on mulle andmebaasiks.
PhP/phpmyadmin selleks, et visuaalselt näha mida ma andmebaasis teen.

Seejärel kloonisin oma enda githubi projekti käsuga: 

sudo git clone https://github.com/sjakobson-arch/PHP.git



Edasisi muudatusi tehes sain käsuga "git pull" ka muudatused veebilehele. Näiteks all oleval pildil on git pull käsk peale seda, kui tegin loogilise varukoopia ja tabelite lisamised.

<img width="1400" height="500" alt="Kuvatõmmis 2026-04-04 165606" src="https://github.com/user-attachments/assets/4e7f4b0b-1769-4f61-8067-45635c30d236" />






Tabelid autorendi andmebaasi lisasin mariadb command-lainil järgmiste käskudega:
(tabelid olin juba varasemalt teinud seega hetkel on error)


<img width="500" height="700" alt="Kuvatõmmis 2026-04-05 141419" src="https://github.com/user-attachments/assets/e404e1b9-743e-4de3-a190-c9b2f456db80" />







Nüüd minnes brauseris oma masina ip-aadressile: 192.168.8.211/phpmyadmin.

Näen tehtud muudatusi.






<img width="1400" height="400" alt="Kuvatõmmis 2026-04-04 170241" src="https://github.com/user-attachments/assets/3dc5d6ee-a0ae-49db-8c38-b2c80d114deb" />




Reservations tabeli testandmed:


<img width="500" height="700" alt="Kuvatõmmis 2026-04-04 170812" src="https://github.com/user-attachments/assets/de9a8190-23be-42c5-af19-d97e88dd9656" />









Tegin varukoopia nii, et exportisin autorent andmebaasi phpmyadmini-s ning laadisin sql faili githubi projekti database kausta nimega "autorent_dump.sql" 



<img width="900" height="300" alt="Kuvatõmmis 2026-04-05 142730" src="https://github.com/user-attachments/assets/ff84f16c-a126-41e8-ad92-9c8423fd51e2" />


<img width="700" height="400" alt="Kuvatõmmis 2026-04-04 171101" src="https://github.com/user-attachments/assets/ceb848c3-5f92-4ae0-b229-f313f443f846" />



Siin on tõestuseks toimiv ning töötav veebileht, mida näen brauseris, kui sisestan masina ip-aadressi (192.168.8.211/autorent):


<img width="2000" height="700" alt="Kuvatõmmis 2026-04-04 171554" src="https://github.com/user-attachments/assets/e568c36c-28e1-42d5-8f40-2be668e9bcdf" />




<img width="2000" height="600" alt="Kuvatõmmis 2026-04-04 171514" src="https://github.com/user-attachments/assets/4e56f56f-fcaf-4352-8117-3b6540d55e7e" />
