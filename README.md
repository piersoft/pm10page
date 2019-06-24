# pm10page

Pagina universale per visualizzare la serie storica e l'ultimo valore assoluto rilevato da centraline IoT.

1) Aprire un account su ThingSpeak con 4 campi : Pm10, Pm2.5, Temperatura e Umidità (in quest'ordine)
2) il file index.php visualizzerà i dati. In modalità Get nell'url passare i parametri :

    channel_id (id canale TSpeak)
    
    readkey (read key del canale TSpeak)
    
    location (nome del luogo dov'è ubicata la centralina)
    
3) opzionalmente ma è raccomandato creare tramite i tutorial di MatLab di TSpeak il secondo canale che registra le medie del PM10 del giorno precedente
   Nella sezione pubblica del secondo canale creare un widget. A questo punto nell'url di index.php si possono aggiungere due parametri:
   
    channel_idmedia (id del canale delle medie del PM10)
    
    widget (il numero del widget)
    
    [Esempio](http://www.piersoft.it/pm10/?channel_id=174342&readkey=EBPJ5UHC8CWPWPSW&location=Casa%20Vacanza%20Excellence%20Matera&channel_idmedia=705275&widget=44574)
    
    
Licenza MIT
