
import mysql.connector
from mysql.connector import Error
from pyparsing import condition_as_parse_action


IMAGES_DIR = ".\\images"
USERNAME = "donzoma09"
PASSWORD = "lambergeneko09"
DATABASENAME = 'mhbooks'
HOST = "localhost"


'''
    the BOOKS table has
    primary key
    name 
    author name
    forignkey to author 
    rating
    reviews
    description
    url_img
    generes (string)

'''

def checkTableExists(cursor, tablename):
    cursor.execute("""
        SELECT COUNT(*)
        FROM information_schema.tables
        WHERE table_name = '{0}'
        """.format(tablename.replace('\'', '\'\'')))
    if cursor.fetchone()[0] == 1:

        return True

    return False


BOOKS = [
    {
        "name": "The Long Way to a Small, Angry Planet",
        "info": '''Follow a motley crew on an exciting journey through space-and one adventurous young explorer who discovers the meaning of family in the far reaches of the universe-in this light-hearted debut space opera from a rising sci-fi star.

Rosemary Harper doesn’t expect much when she joins the crew of the aging Wayfarer. While the patched-up ship has seen better days, it offers her a bed, a chance to explore the far-off corners of the galaxy, and most importantly, some distance from her past. An introspective young woman who learned early to keep to herself, she’s never met anyone remotely like the ship’s diverse crew, including Sissix, the exotic reptilian pilot, chatty engineers Kizzy and Jenks who keep the ship running, and Ashby, their noble captain.

Life aboard the Wayfarer is chaotic and crazy—exactly what Rosemary wants. It’s also about to get extremely dangerous when the crew is offered the job of a lifetime. Tunneling wormholes through space to a distant planet is definitely lucrative and will keep them comfortable for years. But risking her life wasn’t part of the plan. In the far reaches of deep space, the tiny Wayfarer crew will confront a host of unexpected mishaps and thrilling adventures that force them to depend on each other. To survive, Rosemary’s got to learn how to rely on this assortment of oddballs—an experience that teaches her about love and trust, and that having a family isn’t necessarily the worst thing in the universe.''',
        "url_img" : f"{IMAGES_DIR}\\books\\The Long Way to a Small, Angry Planet.jpg",   
        "author_name" : "Becky Chambers" ,
        "author_key" : 0,
        "rating" : '4.16',
        "review" : '107,004',
        "genres" : 'Science Fiction',
    },
    {
        "name": "A Closed and Common Orbit",
        "info": '''Lovelace was once merely a ship's artificial intelligence. When she wakes up in an new body, following a total system shut-down and reboot, she has no memory of what came before. As Lovelace learns to negotiate the universe and discover who she is, she makes friends with Pepper, an excitable engineer, who's determined to help her learn and grow.

Together, Pepper and Lovey will discover that no matter how vast space is, two people can fill it together.

The Long Way to a Small, Angry Planet introduced readers to the incredible world of Rosemary Harper, a young woman with a restless soul and secrets to keep. When she joined the crew of the Wayfarer, an intergalactic ship, she got more than she bargained for - and learned to live with, and love, her rag-tag collection of crewmates.

A Closed and Common Orbit is the stand-alone sequel to Becky Chambers' beloved debut novel The Long Way to a Small, Angry Planet and is perfect for fans of Firefly, Joss Whedon, Mass Effect and Star Wars.''',
        "url_img" : f"{IMAGES_DIR}\\books\\A Closed and Common Orbit.jpg",   
        "author_name" : "Becky Chambers",
        "author_key" : 0,
        "rating" : "4.35",
        "review" : "51,290",
        "genres" : 'Science Fiction',
    },
    {
        "name": "Record of a Spaceborn Few",
        "info": '''Centuries after the last humans left Earth, the Exodus Fleet is a living relic, a place many are from but few outsiders have seen. Humanity has finally been accepted into the galactic community, but while this has opened doors for many, those who have not yet left for alien cities fear that their carefully cultivated way of life is under threat.

Tessa chose to stay home when her brother Ashby left for the stars, but has to question that decision when her position in the Fleet is threatened.

Kip, a reluctant young apprentice, itches for change but doesn't know where to find it.

Sawyer, a lost and lonely newcomer, is just looking for a place to belong.

When a disaster rocks this already fragile community, those Exodans who still call the Fleet their home can no longer avoid the inescapable question:

What is the purpose of a ship that has reached its destination?''',
        "url_img" : f"{IMAGES_DIR}\\books\\Record of a Spaceborn Few.jpg",   
        "author_name" :"Becky Chambers" ,
        "author_key" : 0,
        "rating" : "4.10",
        "review" : "33,046",
        "genres" : "Science Fiction",
    },
    {
        "name": "To Be Taught, If Fortunate",
        "info": '''In her new novella, Sunday Times best-selling author Becky Chambers imagines a future in which, instead of terraforming planets to sustain human life, explorers of the solar system instead transform themselves.

Ariadne is one such explorer. As an astronaut on an extrasolar research vessel, she and her fellow crewmates sleep between worlds and wake up each time with different features. Her experience is one of fluid body and stable mind and of a unique perspective on the passage of time. Back on Earth, society changes dramatically from decade to decade, as it always does.

Ariadne may awaken to find that support for space exploration back home has waned, or that her country of birth no longer exists, or that a cult has arisen around their cosmic findings, only to dissolve once more by the next waking. But the moods of Earth have little bearing on their mission: to explore, to study, and to send their learnings home.

Carrying all the trademarks of her other beloved works, including brilliant writing, fantastic world-building and exceptional, diverse characters, Becky's first audiobook outside of the Wayfarers series is sure to capture the imagination of listeners all over the world.''',
        "url_img" : f"{IMAGES_DIR}\\books\\To Be Taught, If Fortunate.jpg",   
        "author_name" : "Becky Chambers" ,
        "author_key" : 0,
        "rating" : '4.21',
        "review" : '28.384',
        "genres" : 'Science Fiction',
    },
    {
        "name": "A Psalm for the Wild-Built",
        "info": '''Centuries before, robots of Panga gained self-awareness, laid down their tools, wandered, en masse into the wilderness, never to be seen again. They faded into myth and urban legend.

Now the life of the tea monk who tells this story is upended by the arrival of a robot, there to honor the old promise of checking in. The robot cannot go back until the question of "what do people need?" is answered. But the answer to that question depends on who you ask, and how. They will need to ask it a lot. Chambers' series asks: in a world where people have what they want, does having more matter?''',
        "url_img" : f"{IMAGES_DIR}\\books\\A Psalm for the Wild-Built.jpg",
        "author_name" : "Becky Chambers",
        "author_key" : 0,
        "rating" : "4.28",
        "review" : "27,018",
        "genres" : "Science Fiction",
    },
    {
        "name": "And Then There Were None",
        "info": '''First, there were ten—a curious assortment of strangers summoned as weekend guests to a little private island off the coast of Devon. Their host, an eccentric millionaire unknown to all of them, is nowhere to be found. All that the guests have in common is a wicked past they're unwilling to reveal—and a secret that will seal their fate. For each has been marked for murder. A famous nursery rhyme is framed and hung in every room of the mansion:

"Ten little boys went out to dine; One choked his little self and then there were nine. Nine little boys sat up very late; One overslept himself and then there were eight. Eight little boys traveling in Devon; One said he'd stay there then there were seven. Seven little boys chopping up sticks; One chopped himself in half and then there were six. Six little boys playing with a hive; A bumblebee stung one and then there were five. Five little boys going in for law; One got in Chancery and then there were four. Four little boys going out to sea; A red herring swallowed one and then there were three. Three little boys walking in the zoo; A big bear hugged one and then there were two. Two little boys sitting in the sun; One got frizzled up and then there was one. One little boy left all alone; He went out and hanged himself and then there were none."

When they realize that murders are occurring as described in the rhyme, terror mounts. One by one they fall prey. Before the weekend is out, there will be none. Who has choreographed this dastardly scheme? And who will be left to tell the tale? Only the dead are above suspicion. ''',
        "url_img" :f"{IMAGES_DIR}\\books\\And Then There Were None.jpg"  ,   
        "author_name" : "Agatha Christie",
        "author_key" : 1,
        "rating" : "4.27",
        "review" : "1,069,861",
        "genres" : "Mystery",
    },
    {
        "name": "Murder on the Orient Express" ,
        "info": '''Just after midnight, a snowdrift stops the famous Orient Express in its tracks as it travels through the mountainous Balkans. The luxurious train is surprisingly full for the time of the year but, by the morning, it is one passenger fewer. An American tycoon lies dead in his compartment, stabbed a dozen times, his door locked from the inside.

One of the passengers is none other than detective Hercule Poirot. On vacation.

Isolated and with a killer on board, Poirot must identify the murderer—in case he or she decides to strike again.

Librarian's note: the first fifteen novels in the Hercule Poirot series are 1) The Mysterious Affair at Styles, 1920; 2) The Murder on the Links, 1923; 3) The Murder of Roger Ackroyd, 1926; 4) The Big Four, 1927; 5) The Mystery of the Blue Train, 1928; 6) Peril at End House, 1932; 7) Lord Edgware Dies, 1933; 8) Murder on the Orient Express, 1934; 9) Three Act Tragedy, 1935; 10) Death in the Clouds, 1935; 11) The A.B.C. Murders, 1936; 12) Murder in Mesopotamia, 1936; 13) Cards on the Table, 1936; 14) Dumb Witness, 1937; and 15) Death on the Nile, 1937. These are just the novels; Poirot also appears in this period in a play, Black Coffee, 1930, and two collections of short stories, Poirot Investigates, 1924, and Murder in the Mews, 1937. Each novel, play and short story has its own entry on Goodreads.''',
        "url_img" :f"{IMAGES_DIR}\\books\\Murder on the Orient Express.jpg"  ,   
        "author_name" : "Agatha Christie",
        "author_key" : 1,
        "rating" : '4.19',
        "review" : '31,318',
        "genres" : 'Mystery',
    },
    {
        "name": "The Mysterious Affair at Styles" ,
        "info": '''Agatha Christie's debut novel was also the first to feature Hercule Poirot, her famously eccentric Belgian detective.

A refugee of the Great War, Poirot has settled in England near Styles Court, the country estate of his wealthy benefactor, the elderly Emily Inglethorp. When Emily is poisoned and the authorities are baffled, Poirot puts his prodigious sleuthing skills to work. Suspects are plentiful, including the victim’s much younger husband, her resentful stepsons, her longtime hired companion, a young family friend working as a nurse, and a London specialist on poisons who just happens to be visiting the nearby village.

All of them have secrets they are desperate to keep, but none can outwit Poirot as he navigates the ingenious red herrings and plot twists that contribute to Agatha Christie's well-deserved reputation as the queen of mystery.

Librarian's note: the first fifteen novels in the Hercule Poirot series are 1) The Mysterious Affair at Styles, 1920; 2) The Murder on the Links, 1923; 3) The Murder of Roger Ackroyd, 1926; 4) The Big Four, 1927; 5) The Mystery of the Blue Train, 1928; 6) Peril at End House, 1932; 7) Lord Edgware Dies, 1933; 8) Murder on the Orient Express, 1934; 9) Three Act Tragedy, 1935; 10) Death in the Clouds, 1935; 11) The A.B.C. Murders, 1936; 12) Murder in Mesopotamia, 1936; 13) Cards on the Table, 1936; 14) Dumb Witness, 1937; and 15) Death on the Nile, 1937. These are just the novels; Poirot also appears in this period in a play, Black Coffee, 1930, and two collections of short stories, Poirot Investigates, 1924, and Murder in the Mews, 1937. Each novel, play and short story has its own entry on Goodreads.''',
        "url_img" :f"{IMAGES_DIR}\\books\\The Mysterious Affair at Styles.jpg"  ,   
        "author_name" : "Agatha Christie",
        "author_key" :1,
        "rating" : '3.99',
        "review" : '110,740',
        "genres" : 'Mystery',
    },
    {
        "name": "The Murder of Roger Ackroyd" ,
        "info": '''Considered to be one of Agatha Christie's greatest, and also most controversial mysteries, 'The Murder Of Roger Ackroyd' breaks the rules of traditional mystery.

The peaceful English village of King's Abbot is stunned. The widow Ferrars dies from an overdose of Veronal. Not twenty-four hours later, Roger Ackroyd—the man she had planned to marry—is murdered. It is a baffling case involving blackmail and death that taxes Hercule Poirot’s “little grey cells” before he reaches one of the most startling conclusions of his career.

Librarian's note: the first fifteen novels in the Hercule Poirot series are 1) The Mysterious Affair at Styles, 1920; 2) The Murder on the Links, 1923; 3) The Murder of Roger Ackroyd, 1926; 4) The Big Four, 1927; 5) The Mystery of the Blue Train, 1928; 6) Peril at End House, 1932; 7) Lord Edgware Dies, 1933; 8) Murder on the Orient Express, 1934; 9) Three Act Tragedy, 1935; 10) Death in the Clouds, 1935; 11) The A.B.C. Murders, 1936; 12) Murder in Mesopotamia, 1936; 13) Cards on the Table, 1936; 14) Dumb Witness, 1937; and 15) Death on the Nile, 1937. These are just the novels; Poirot also appears in this period in a play, Black Coffee, 1930, and two collections of short stories, Poirot Investigates, 1924, and Murder in the Mews, 1937. Each novel, play and short story has its own entry on Goodreads.''',
        "url_img" :f"{IMAGES_DIR}\\books\\The Murder of Roger Ackroyd.jpg"  ,   
        "author_name" : "Agatha Christie",
        "author_key" :1,
        "rating" : '4.26',
        "review" : '207,210',
        "genres" : 'Mystery',
    },
    {
        "name": "Death on the Nile" ,
        "info": '''Agatha Christie's most daring travel mystery.

The tranquility of a lovely cruise along the Nile is shattered by the discovery that Linnet Ridgeway has been shot. She was young, stylish and beautiful, a girl who had everything – until she lost her life.

Who is also on board? Christie's great detective Hercule Poirot is on holiday. He recalls an earlier outburst by a fellow passenger: ‘I’d like to put my dear little pistol against her head and just press the trigger.’ Despite the exotic setting, nothing is ever quite what it seems…

Librarian's note: this Hercule Poirot novel should not be confused with the short story of the same name also by Christie. It starred Parker Pyne and came out several years earlier. The title and locale are the same, but the contents are quite different. It is not a precursor of this story. The Pyne short story can be found elsewhere on Goodreads.''',
        "url_img" :f"{IMAGES_DIR}\\books\\Death on the Nile.jpg"  ,   
        "author_name" : "Agatha Christie",
        "author_key" :1,
        "rating" : '4.12',
        "review" : '199,176',
        "genres" : 'Mystery',
    },
    {
        "name": "Reminders of Him" ,
        "info": '''After serving five years in prison for a tragic mistake, Kenna Rowan returns to the town where it all went wrong, hoping to reunite with her four-year-old daughter. But the bridges Kenna burned are proving impossible to rebuild. Everyone in her daughter’s life is determined to shut Kenna out, no matter how hard she works to prove herself.

The only person who hasn’t closed the door on her completely is Ledger Ward, a local bar owner and one of the few remaining links to Kenna’s daughter. But if anyone were to discover how Ledger is slowly becoming an important part of Kenna’s life, both would risk losing the trust of everyone important to them.

The two form a connection despite the pressure surrounding them, but as their romance grows, so does the risk. Kenna must find a way to absolve the mistakes of her past in order to build a future out of hope and healing.''',
        "url_img" :f"{IMAGES_DIR}\\books\\Reminders of Him.jpg"  ,   
        "author_name" : "Colleen Hoover",
        "author_key" :2,
        "rating" : '4.55',
        "review" : '289,456',
        "genres" : 'Romance',
    },
    {
        "name": "Confess" ,
        "info": '''Auburn Reed is determined to rebuild her shattered life and she has no room for mistakes. But when she walks into a Dallas art studio in search of a job, she doesn’t expect to become deeply attracted to the studio’s enigmatic artist, Owen Gentry.

For once, Auburn takes a chance and puts her heart in control, only to discover that Owen is hiding a huge secret. The magnitude of his past threatens to destroy everything Auburn loves most, and the only way to get her life back on track is to cut Owen out of it—but can she do it?''',
        "url_img" :f"{IMAGES_DIR}\\books\\Confess.jpg"  ,   
        "author_name" : "Colleen Hoover",
        "author_key" :2,
        "rating" : '4.21',
        "review" : '210,828',
        "genres" : 'Romance',
    },
    {
        "name": "Ugly Love" ,
        "info": '''When Tate Collins meets airline pilot Miles Archer, she knows it isn’t love at first sight. They wouldn’t even go so far as to consider themselves friends. The only thing Tate and Miles have in common is an undeniable mutual attraction. Once their desires are out in the open, they realize they have the perfect set-up. He doesn’t want love, she doesn’t have time for love, so that just leaves the sex. Their arrangement could be surprisingly seamless, as long as Tate can stick to the only two rules Miles has for her.

Never ask about the past.
Don’t expect a future.

They think they can handle it, but realize almost immediately they can’t handle it at all.

Hearts get infiltrated.
Promises get broken.
Rules get shattered.
Love gets ugly.''',
        "url_img" :f"{IMAGES_DIR}\\books\\Ugly Love.jpg"  ,   
        "author_name" : "Colleen Hoover",
        "author_key" :2,
        "rating" : '4.25',
        "review" : '646,544',
        "genres" : 'Romance',
    },
    {
        "name": "November 9" ,
        "info": '''Fallon meets Ben, an aspiring novelist, the day before her scheduled cross-country move. Their untimely attraction leads them to spend Fallon’s last day in L.A. together, and her eventful life becomes the creative inspiration Ben has always sought for his novel. Over time and amidst the various relationships and tribulations of their own separate lives, they continue to meet on the same date every year. Until one day Fallon becomes unsure if Ben has been telling her the truth or fabricating a perfect reality for the sake of the ultimate plot twist.

Can Ben’s relationship with Fallon—and simultaneously his novel—be considered a love story if it ends in heartbreak?

Beloved #1 New York Times bestselling author Colleen Hoover returns with an unforgettable love story between a writer and his unexpected muse.''',
        "url_img" :f"{IMAGES_DIR}\\books\\November 9.jpg"  ,   
        "author_name" : "Colleen Hoover",
        "author_key" :2,
        "rating" : '4.33',
        "review" : '369,202',
        "genres" : 'Romance',
    },
    {
        "name": "It Ends with Us" ,
        "info": '''Sometimes it is the one who loves you who hurts you the most.

Lily hasn’t always had it easy, but that’s never stopped her from working hard for the life she wants. She’s come a long way from the small town in Maine where she grew up — she graduated from college, moved to Boston, and started her own business. So when she feels a spark with a gorgeous neurosurgeon named Ryle Kincaid, everything in Lily’s life suddenly seems almost too good to be true.

Ryle is assertive, stubborn, maybe even a little arrogant. He’s also sensitive, brilliant, and has a total soft spot for Lily. And the way he looks in scrubs certainly doesn’t hurt. Lily can’t get him out of her head. But Ryle’s complete aversion to relationships is disturbing. Even as Lily finds herself becoming the exception to his “no dating” rule, she can’t help but wonder what made him that way in the first place.

As questions about her new relationship overwhelm her, so do thoughts of Atlas Corrigan — her first love and a link to the past she left behind. He was her kindred spirit, her protector. When Atlas suddenly reappears, everything Lily has built with Ryle is threatened.''',
        "url_img" :f"{IMAGES_DIR}\\books\\It Ends with Us.jpg"  ,   
        "author_name" : "Colleen Hoover",
        "author_key" :2,
        "rating" : '4.42',
        "review" : '1,165,545',
        "genres" : 'Romance',
    },

    
]

'''
    THE AUTHOURS table HAS 
    primary key
    name 
    description 
    url picture
'''

AUTHORS = [
    {
        "name": "Becky Chambers" ,
        "info": '''Becky Chambers is a science fiction author based in Northern California. She is best known for her Hugo Award-winning Wayfarers series, which currently includes The Long Way to a Small, Angry Planet, A Closed and Common Orbit, and Record of a Spaceborn Few. Her books have also been nominated for the Arthur C. Clarke Award, the Locus Award, and the Women's Prize for Fiction, among others. Her most recent work is To Be Taught, If Fortunate, a standalone novella.
    Becky has a background in performing arts, and grew up in a family heavily involved in space science. She spends her free time playing video and tabletop games, keeping bees, and looking through her telescope. Having hopped around the world a bit, she’s now back in her home state, where she lives with her wife. She hopes to see Earth from orbit one day.
         ''' ,
        "url_img" : f"{IMAGES_DIR}\\authors\\Becky Chambers.jpg" ,   
    },
    {
        "name": "Agatha Christie",
        "info": '''Agatha Christie is the best-selling author of all time. She wrote 66 crime novels and story collections, fourteen plays, and six novels under a pseudonym in Romance. Her books have sold over a billion copies in the English language and a billion in translation. According to Index Translationum, she remains the most-translated individual author, having been translated into at least 103 languages. She is the creator of two of the most enduring figures in crime literature-Hercule Poirot and Miss Jane Marple-and author of The Mousetrap, the longest-running play in the history of modern theatre.

Agatha Mary Clarissa Miller was born in Torquay, Devon, England, U.K., as the youngest of three. The Millers had two other children: Margaret Frary Miller (1879–1950), called Madge, who was eleven years Agatha's senior, and Louis Montant Miller (1880–1929), called Monty, ten years older than Agatha.

Before marrying and starting a family in London, she had served in a Devon hospital during the First World War, tending to troops coming back from the trenches. During the First World War, she worked at a hospital as a nurse; later working at a hospital pharmacy, a job that influenced her work, as many of the murders in her books are carried out with poison. During the Second World War, she worked as a pharmacy assistant at University College Hospital, London, acquiring a good knowledge of poisons which feature in many of her novels.

Her first novel, The Mysterious Affair at Styles, came out in 1920. During her first marriage, Agatha published six novels, a collection of short stories, and a number of short stories in magazines.

In late 1926, Agatha's husband, Archie, revealed that he was in love with another woman, Nancy Neele, and wanted a divorce. On 8 December 1926 the couple quarreled, and Archie Christie left their house, Styles, in Sunningdale, Berkshire, to spend the weekend with his mistress at Godalming, Surrey. That same evening Agatha disappeared from her home, leaving behind a letter for her secretary saying that she was going to Yorkshire. Her disappearance caused an outcry from the public, many of whom were admirers of her novels. Despite a massive manhunt, she was not found for eleven days.

In 1930, Christie married archaeologist Max Mallowan (Sir Max from 1968) after joining him in an archaeological dig. Their marriage was especially happy in the early years and remained so until Christie's death in 1976.

Christie frequently used familiar settings for her stories. Christie's travels with Mallowan contributed background to several of her novels set in the Middle East. Other novels (such as And Then There Were None) were set in and around Torquay, where she was born. Christie's 1934 novel Murder on the Orient Express was written in the Hotel Pera Palace in Istanbul, Turkey, the southern terminus of the railway. The hotel maintains Christie's room as a memorial to the author. The Greenway Estate in Devon, acquired by the couple as a summer residence in 1938, is now in the care of the National Trust.

Christie often stayed at Abney Hall in Cheshire, which was owned by her brother-in-law, James Watts. She based at least two of her stories on the hall: the short story The Adventure of the Christmas Pudding, and the novel After the Funeral. Abney Hall became Agatha's greatest inspiration for country-house life, with all the servants and grandeur which have been woven into her plots.


To honour her many literary works, she was appointed Commander of the Order of the British Empire in the 1956 New Year Honours. The next year, she became the President of the Detection Club.''' ,
        "url_img" :f"{IMAGES_DIR}\\authors\\Agatha Christie.jpg" ,     
    },
    {
        "name": "Colleen Hoover" ,
        "info": '''Colleen Hoover (Margaret Colleen Fennell) (born December 11, 1979) is an author of young adult fiction and romance novels.

She published her first novel, Slammed, in January 2012. In December 2012, she published Hopeless, which rose to the top of the New York Times best seller list. Many of her works have been self-published before being picked up by a publishing house.

Hoover was born on December 11, 1979, in Sulphur Springs, Texas, to Vannoy Fite and Eddie Fennell. She grew up in Saltillo, Texas, and graduated from Saltillo High School in 1998. In 2000, she married Heath Hoover, with whom she has three sons. Hoover graduated from Texas A&M-Commerce with a degree in social work. She worked various social work and teaching jobs until starting her writing career.

In November 2011, Hoover began her first novel, Slammed, with no intention of getting published. She was inspired by a lyric, "decide what to be and go be it", from an Avett Brothers song, "Head Full of Doubt/Road Full of Promise." Because of this, she incorporated Avett Brothers lyrics throughout the story. After a few months, her novel was reviewed and given 5 stars by book blogger Maryse Black, after which sales rapidly took off for her first two books.''' ,
        "url_img" : f"{IMAGES_DIR}\\authors\\Colleen Hoover.jpg" ,   
    },
]

QUOTES = [
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“All you can do, Rosemary – all any of us can do – is work to be something positive instead. That is a choice that every sapient must make every day of their life. The universe is what we make of it. It’s up to you to decide what part you will play.”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“I can wait for the galaxy outside to get a little kinder.”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“We cannot blame ourselves for the wars our parents start. Sometimes the very best thing we can do is walk away.”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“That’s not the same. What happened to you, to your species, it’s . . . it doesn’t even compare.’ ‘Why? Because it’s worse?’ She nodded. ‘But it still compares. If you have a fractured bone, and I’ve broken every bone in my body, does that make your fracture go away? Does it hurt you any less, knowing that I am in more pain?”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“People can do terrible things when they feel safe and powerful.”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“The people we remember are the ones who decided how our maps should be drawn. Nobody remembers who built the roads.”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“Humans’ preoccupation with ‘being happy’ was something he had never been able to figure out. No sapient could sustain happiness all of the time, just as no one could live permanently within anger, or boredom, or grief.”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“Do not judge other species by your own social norms”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“No sapient could sustain happiness all of the time, just as no one could live permanently within anger, or boredom, or grief.”",
        "bookId" : "0",
    },
    {
        "bookName": "The Long Way to a Small, Angry Planet",
        "info" : "“Such a quintessentially Human thing, to express sorrow through apology.”",
        "bookId" : "0",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“At the core, you’ve got to get university certification for parenting, just as you do for, say, being a doctor or an engineer. No offence to you or your species, but going into the business of creating life without any sort of formal prep is . . .’ He laughed. ‘It’s baffling. But then, I’m biased.”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“Most sapients confuse working hard with being miserable.”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“I love learning. I love history. But there's history in everything. Every building, everybody you talk to. It's not limited to libraries and museums. I think people who spend their lives in school forget that sometimes. -Tak”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“And seriously, anybody working in a job that doesn’t let you take a nap when you need to should get a new job.”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“Are we going for an anchor or a compass? A memory to ground you, or a spark to guide you forward?”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“Just because someone goes away doesn't mean you stop loving them.”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“There are few better ways to get to know how a species thinks than to learn their art.”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“There were dozens of stars. Dozens of dozens, way too many to count, just like her questions.”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“It was hard to play it cool when you wore your heart on your face.”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“The planet was beautiful. The planet was horrible. The planet was full of people, and they were beautiful and horrible, too.”",
        "bookId" : "1",
    },
    {
        "bookName": "A Closed and Common Orbit",
        "info" : "“She was glad to have met someone who liked to read.”",
        "bookId" : "1",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“From the ground, we stand. From our ships, we live. By the stars, we hope.”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“The guilt lingered, even so. Ghosts were imaginary, but hauntings were real.”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“Our species doesn’t operate by reality. It operates by stories. Cities are a story. Money is a story. Space was a story, once. A king tells us a story about who we are and why we’re great, and that story is enough to make us go kill people who tell a different story. Or maybe the people kill the king because they don’t like his story and have begun to tell themselves a different one.”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“We are a longstanding species with a very short memory. If we don’t keep record, we’ll make the same mistakes over and over again.”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“From the stars, came the ground. From the ground, we stood. To the ground, we return”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“Figure out what you love, specifically. In detail. Figure out what you want to keep. Figure out what you want to change. Otherwise, it’s not love. It’s clinging to the familiar”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“My own research methodology professor phrased this concept succinctly: learn nothing of your subjects, and you will disrupt them. Learn something of your subjects, and you will disrupt them.”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“Academic prowess and base intelligence are two separate things.”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“We’re made out of our ancestors. They’re what keep us alive.”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“If you never leave, you'll always wonder.  You'll wonder what your life could've been, if you did the right thing. Well... scratch that. You'll always wonder if you did the right thing, no matter what your decision is, big or small.  There's always another path you'll wonder about.”",
        "bookId" : "2",
    },
    {
        "bookName": "Record of a Spaceborn Few",
        "info" : "“We're our own warning.”",
        "bookId" : "2",
    },
    {
        "bookName": "To Be Taught, If Fortunate",
        "info" : "“We step out of our solar system into the universe seeking only peace and friendship – to teach, if we are called upon; to be taught, if we are fortunate.”",
        "bookId" : "3",
    },
    {
        "bookName": "To Be Taught, If Fortunate",
        "info" : "“At some point, you have to accept the fact that any movement creates waves, and the only other option is to lie still and learn nothing.”",
        "bookId" : "3",
    },
    {
        "bookName": "To Be Taught, If Fortunate",
        "info" : "“We celebrate the tree that stretches to the sky, but it is the ground we should ultimately thank.”",
        "bookId" : "3",
    },
    {
        "bookName": "To Be Taught, If Fortunate",
        "info" : "“Don't believe the lie of individual trees, each a monument to its own self-made success. A forest is an interdependent community. Resources are shared, and life in isolation is a death sentence.”",
        "bookId" : "3",
    },
    {
        "bookName": "To Be Taught, If Fortunate",
        "info" : "“It is difficult to give thought to the stars when the ground is swallowing you up.”",
        "bookId" : "3",
    },
    {
        "bookName": "To Be Taught, If Fortunate",
        "info" : "“The amount a person can spare is relative; the value of generosity is not.”",
        "bookId" : "3",
    },
    {
        "bookName": "To Be Taught, If Fortunate",
        "info" : "“We exist where we begin, yet to remain is death.”",
        "bookId" : "3",
    },
    {
        "bookName": "A Psalm for the Wild-Built",
        "info" : "“You keep asking why your work is not enough, and I don’t know how to answer that, because it is enough to exist in the world and marvel at it. You don’t need to justify that, or earn it. You are allowed to just live.”",
        "bookId" : "4",
    },
    {
        "bookName": "A Psalm for the Wild-Built",
        "info" : "“We don’t have to fall into the same category to be of equal value.”",
        "bookId" : "4",
    },
    {
        "bookName": "A Psalm for the Wild-Built",
        "info" : "“Mosscap considered. “Because I know that no matter what, I’m wonderful,” it said.”",
        "bookId" : "4",
    },
    {
        "bookName": "A Psalm for the Wild-Built",
        "info" : "“Sometimes a person reaches a point in their life when it becomes absolutely essential to get the fuck out of the city”",
        "bookId" : "4",
    },
    {
        "bookName": "A Psalm for the Wild-Built",
        "info" : "“I think there’s something beautiful about being lucky enough to witness a thing on its way out.”",
        "bookId" : "4",
    },
    {
        "bookName": "A Psalm for the Wild-Built",
        "info" : "“We’re all just trying to be comfortable, and well fed, and unafraid.”",
        "bookId" : "4",
    },
    {
        "bookName": "And Then There Were None",
        "info" : "“In the midst of life, we are in death.”",
        "bookId" : "5",
    },
    
    {
        "bookName": "And Then There Were None",
        "info" : "“But no artist, I now realize, can be satisfied with art alone. There is a natural craving for recognition which cannot be gain-said.”",
        "bookId" : "5",
    },
    {
        "bookName": "And Then There Were None",
        "info" : "“I don't know. I don't know at all. And that's what's frightening the life out of me. To have no idea....”",
        "bookId" : "5",
    },
    {
        "bookName": "And Then There Were None",
        "info" : "“Crime is terribly revealing. Try and vary your methods as you will, your tastes, your habits, your attitude of mind, and your soul is revealed by your actions.”",
        "bookId" : "5",
    },
    {
        "bookName": "And Then There Were None",
        "info" : "“The amount of missing girls I've had to trace and their family and their friends always say the same thing. 'She was a bright and affectionate disposition and had no men friends'. That's never true. It's unnatural. Girls ought to have men friends. If not, then there's something wrong about them....”",
        "bookId" : "5",
    },
    {
        "bookName": "Murder on the Orient Express",
        "info" : "“The impossible could not have happened, therefore the impossible must be possible in spite of appearances.”",
        "bookId" : "6",
    },
    {
        "bookName": "Murder on the Orient Express",
        "info" : "“If you confront anyone who has lied with the truth, he will usually admit it - often out of sheer surprise. It is only necessary to guess right to produce your effect.”",
        "bookId" : "6",
    },
    {
        "bookName": "Murder on the Orient Express",
        "info" : "“But I know human nature, my friend, and I tell you that, suddenly confronted with the possibility of being tried for murder, the most innocent person will lose his head and do the most absurd things.”",
        "bookId" : "6",
    },
    {
        "bookName": "Murder on the Orient Express",
        "info" : "“At the small table, sitting very upright, was one of the ugliest old ladies he had ever seen. It was an ugliness of distinction - it fascinated rather than repelled.”",
        "bookId" : "6",
    },
    {
        "bookName": "Murder on the Orient Express",
        "info" : "“The body—the cage—is everything of the most respectable—but through the bars, the wild animal looks out.”",
        "bookId" : "6",
    },
    {
        "bookName": "Murder on the Orient Express",
        "info" : "“I am not one to rely upon the expert procedure. It is the psychology I seek, not the fingerprint or the cigarette ash.”",
        "bookId" : "6",
    },
    {
        "bookName": "The Mysterious Affair at Styles",
        "info" : "“You gave too much rein to your imagination. Imagination is a good servant, and a bad master. The simplest explanation is always the most likely.”",
        "bookId" : "7",
    },
    {
        "bookName": "The Mysterious Affair at Styles",
        "info" : "“Everything must be taken into account. If the fact will not fit the theory---let the theory go.”",
        "bookId" : "7",
    },
    {
        "bookName": "The Mysterious Affair at Styles",
        "info" : "“Every murderer is probably somebody's old friend.”",
        "bookId" : "7",
    },
    {
        "bookName": "The Mysterious Affair at Styles",
        "info" : "“An appreciative listener is always stimulating.”",
        "bookId" : "7",
    },
    {
        "bookName": "The Mysterious Affair at Styles",
        "info" : "“They tried to be too clever---and that was their undoing.”",
        "bookId" : "7",
    },
    {
        "bookName": "The Mysterious Affair at Styles",
        "info" : "“Imagination is a good servant, and a bad master.”",
        "bookId" : "7",
    },
    {
        "bookName": "The Mysterious Affair at Styles",
        "info" : "“... one may live in a big house and yet have no comfort.”",
        "bookId" : "7",
    },
    {
        "bookName": "The Murder of Roger Ackroyd",
        "info" : "“The truth, however ugly in itself, is always curious and beautiful to seekers after it.”",
        "bookId" : "8",
    },
    {
        "bookName": "The Murder of Roger Ackroyd",
        "info" : "“It is completely unimportant. That is why it is so interesting.”",
        "bookId" : "8",
    },
    {
        "bookName": "The Murder of Roger Ackroyd",
        "info" : "“It is odd how, when you have a secret belief of your own which you do not wish to acknowledge, the voicing of it by someone else will rouse you to a fury of denial.”",
        "bookId" : "8",
    },
    {
        "bookName": "The Murder of Roger Ackroyd",
        "info" : "“Women observe subconsciously a thousand little details, without knowing that they are doing so. Their subconscious mind adds these little things together—and they call the result intuition.”",
        "bookId" : "8",
    },
    {
        "bookName": "The Murder of Roger Ackroyd",
        "info" : "“Oh! money! All the troubles in the world can be put down to money—or the lack of it.”",
        "bookId" : "8",
    },
    {
        "bookName": "The Murder of Roger Ackroyd",
        "info" : "“Fortunately words, ingeniously used, will serve to mask the ugliness of naked facts.”",
        "bookId" : "8",
    },
    {
        "bookName": "Death on the Nile",
        "info" : "“Love can be a very frightening thing.’ ‘That is why most great love stories are tragedies.”",
        "bookId" : "9",
    },
    {
        "bookName": "Death on the Nile",
        "info" : "“How true is the saying that man was forced to invent work in order to escape the strain of having to think.”",
        "bookId" : "9",
    },
    {
        "bookName": "Death on the Nile",
        "info" : "“Oh, I'm not afraid of death! What have I got to live for after all? I suppose you believe it's very wrong to kill a person who has injured you-even if they've taken away everything you had in the world?”",
        "bookId" : "9",
    },
    {
        "bookName": "Death on the Nile",
        "info" : "“They conceive a certain theory, and everything has to fit into that theory. If one little fact will not fit it, they throw it aside. But it is always the facts that will not fit in that are significant.”",
        "bookId" : "9",
    },
    {
        "bookName": "Death on the Nile",
        "info" : "“It is not the past that matters,but the future”",
        "bookId" : "9",
    },
    {
        "bookName": "Death on the Nile",
        "info" : "“Love is not everything, Mademoiselle,' Poirot said gently. 'It is only when we are young that we think it is.”",
        "bookId" : "9",
    },
    {
        "bookName": "Death on the Nile",
        "info" : "“Use your eyes. Use your ears. Use your brains---if you've got any. And, if necessary--act.”",
        "bookId" : "9",
    },
    {
        "bookName": "Reminders of Him",
        "info" : "“People say you fall in love, but fall is such a sad word when you think about it. Falls are never good. You fall on the ground, you fall behind, you fall to your death. Whoever was the first person to say they fell in love must have already fallen out of it. Otherwise, they’d have called it something much better.”",
        "bookId" : "10",
    },
    {
        "bookName": "Reminders of Him",
        "info" : "“Now that I’ve forgiven myself, the reminders of him only make me smile.”",
        "bookId" : "10",
    },
    {
        "bookName": "Reminders of Him",
        "info" : "“There was before you and there was during you. For some reason, I never thought there would be an after you.”",
        "bookId" : "10",
    },
    {
        "bookName": "Reminders of Him",
        "info" : "“Reading is a hobby, but for some of us, it’s an escape from the difficulties we face. To all of you who escape into books, I want to thank you for escaping into this one.”",
        "bookId" : "10",
    },
    {
        "bookName": "Reminders of Him",
        "info" : "“We’re all just a bunch of sad people doing what we have to do to make it until tomorrow.”",
        "bookId" : "10",
    },
    {
        "bookName": "Reminders of Him",
        "info" : "“Maybe it doesn’t matter whether something is a coincidence or a sign. Maybe the best way to cope with the loss of the people we love is to find them in as many places and things as we possibly can. And in the off chance that the people we lose are still somehow able to hear us, maybe we should never stop talking to them.”",
        "bookId" : "10",
    },
    {
        "bookName": "Confess",
        "info" : "“There are people you meet that you get to know, and then there are people you meet that you already know.”",
        "bookId" : "11",
    },
    {
        "bookName": "Confess",
        "info" : "“Selflessness. It should be the basis of every relationship. If a person truly cares about you, they'll get more pleasure from the way they make you feel, rather than the way you make them feel.”",
        "bookId" : "11",
    },
    {
        "bookName": "Confess",
        "info" : "“I'm afraid if I listen to my heart once, I'll never figure out how to ignore it again.”",
        "bookId" : "11",
    },
    {
        "bookName": "Confess",
        "info" : "“It’s amazing how much distance one truth can create between two people.”",
        "bookId" : "11",
    },
    {
        "bookName": "Confess",
        "info" : "“I think love is a hard word to define,” I say to her. “You can love a lot of things about a person but still not love the whole person.”",
        "bookId" : "11",
    },
    {
        "bookName": "Confess",
        "info" : "“Please don’t allow anyone to make you feel less than what you are.”",
        "bookId" : "11",
    },
    {
        "bookName": "Confess",
        "info" : "“Some secrets should never turn into confessions. I know that better than anyone.”",
        "bookId" : "11",
    },
    {
        "bookName": "Ugly Love",
        "info" : "“Love isn't always pretty. Sometimes you spend all your time hoping it'll eventually be something different. Something better. Then, before you know it, you're back to square one, and you lost your heart somewhere along the way.”",
        "bookId" : "12",
    },
    {
        "bookName": "Ugly Love",
        "info" : "“God gives us the ugliness so we don’t take the beautiful things in life for granted.”",
        "bookId" : "12",
    },
    {
        "bookName": "Ugly Love",
        "info" : "“When life gives you lemons, make sure you know whose eyes you need to squeeze them in.”",
        "bookId" : "12",
    },
    {
        "bookName": "Ugly Love",
        "info" : "“Sometimes not speaking says more than all the words in the world.”",
        "bookId" : "12",
    },
    {
        "bookName": "Ugly Love",
        "info" : "“Ugly love becomes you. Consumes you. Makes you hate it all. Makes you realize that all the beautiful parts aren't even worth it. Without the beautiful, you'll never risk feeling the ugly. So you give it all up. You give it all up. You never want love again, no matter what kind it is, because no type of love will ever be worth living through the ugly love again.”",
        "bookId" : "12",
    },
    {
        "bookName": "Ugly Love",
        "info" : "“Some people they grow wiser as they grow older. Unfortunately, most people just grow older.”",
        "bookId" : "12",
    },
    {
        "bookName": "November 9",
        "info" : "“You’ll never be able to find yourself if you’re lost in someone else.”",
        "bookId" : "13",
    },
    {
        "bookName": "November 9",
        "info" : "“When you find love, you take it. You grab it with both hands and you do everything in your power not to let it go. You can’t just walk away from it and expect it to linger until you’re ready for it.”",
        "bookId" : "13",
    },
    {
        "bookName": "November 9",
        "info" : "“She’s not the kind of girl you choose your battles for. She’s the kind of girl you fight to the death for.”",
        "bookId" : "13",
    },
    {
        "bookName": "November 9",
        "info" : "“I thought I was stronger than a word, but I just discovered that having to say goodbye to you is by far the hardest thing I’ve ever had to do.”",
        "bookId" : "13",
    },
    {
        "bookName": "November 9",
        "info" : "“It took four years for me to fall in love with him. It only took four pages to stop.”",
        "bookId" : "13",
    },
    {
        "bookName": "November 9",
        "info" : "“Sigh" "Did you just say sigh? out loud? instead of actually sighing? ''Eye roll""",
        "bookId" : "13",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“There is no such thing as bad people. We’re all just people who sometimes do bad things.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“It stops here. With me and you. It ends with us.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“All humans make mistakes. What determines a person's character aren't the mistakes we make. It's how we take those mistakes and turn them into lessons rather than excuses.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“He pulls back to look down at me and when he sees my tears, he brings his hands up to my cheeks. “In the future... if by some miracle you ever find yourself in the position to fall in love again... fall in love with me.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“Just because someone hurts you doesn't mean you can simply stop loving them. It's not a person's actions that hurt the most. It's the love. If there was no love attached to the action, the pain would be a little easier to bear.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“You can stop swimming now, Lily. We finally reached the shore.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“Just because we didn’t end up on the same wave, doesn’t mean we aren’t still a part of the same ocean.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“Fifteen seconds. That’s all it takes to completely change everything about a person. Fifteen.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“Naked truths aren’t always pretty.”",
        "bookId" : "14",
    },
    {
        "bookName": "It Ends with Us",
        "info" : "“And as hard as this choice is, we break the pattern before the pattern breaks us.”",
        "bookId" : "14",
    },



]

mydb = mysql.connector.connect(
host=HOST,
user=USERNAME,
password=PASSWORD,
)
mycursor = mydb.cursor()
mycursor.execute("SHOW DATABASES")
condition = False
for x in mycursor:
    if x[0] == DATABASENAME:
        condition = True
        break
if(condition):
    mydb.close()
    mydb = mysql.connector.connect(
    host=HOST,
    user=USERNAME,
    password=PASSWORD,
    database = DATABASENAME
    )

else:
    mycursor.execute(f"CREATE DATABASE {DATABASENAME}");
    mydb.close()
    print("asd")
    mydb = mysql.connector.connect(
    host=HOST,
    user=USERNAME,
    password=PASSWORD,
    database = DATABASENAME
    )
mycursor = mydb.cursor()


# delete database
sql = "DROP TABLE IF EXISTS UserBooks"
mycursor.execute(sql)
sql = "DROP TABLE IF EXISTS Comment"
mycursor.execute(sql)
sql = "DROP TABLE IF EXISTS BookLike"
mycursor.execute(sql)
sql = "DROP TABLE IF EXISTS QuoteLike"
mycursor.execute(sql)
sql = "DROP TABLE IF EXISTS User"
mycursor.execute(sql)
sql = "DROP TABLE IF EXISTS Quote"
mycursor.execute(sql)
sql = "DROP TABLE IF EXISTS Book"
mycursor.execute(sql)
sql = "DROP TABLE IF EXISTS Author"
mycursor.execute(sql)



# check Authors table 


x = """CREATE TABLE Author (
            AuthorID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            Name VARCHAR(100) NOT NULL,
            Info TEXT NOT NULL,
            Image TEXT NOT NULL
            )""" 
mycursor.execute(x)

sql = "INSERT INTO Author (name, info, image) VALUES (%s, %s, %s)"
val = [
    (x['name'] , x['info'] , x['url_img']) for x in AUTHORS
]
mycursor.executemany(sql, val)
mydb.commit()

#________________________
# check the books table 

sql = "DROP TABLE IF EXISTS Book"
mycursor.execute(sql)

x = """CREATE TABLE Book (
            BookID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            Name VARCHAR(100) NOT NULL,
            Info TEXT NOT NULL,
            Image TEXT NOT NULL,
            AutherName VARCHAR(100) NOT NULL,
            AuthorID INT,
            Rating TEXT NOT NULL,
            Reviews TEXT NOT NULL,
            Genres TEXT NOT NULL,
            CONSTRAINT FK_BookAuathor FOREIGN KEY (AuthorID)
            REFERENCES Author(AuthorID)
            )""" 
mycursor.execute(x)

sql = "INSERT INTO Book (name, info, image, AutherName, AuthorID, Rating, Reviews, Genres) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
val = [
    (x['name'] , x['info'] , x['url_img'] , x['author_name'] , x['author_key'] + 1 , x['rating'] , x['review'] , x['genres']) for x in BOOKS
]
mycursor.executemany(sql, val)
mydb.commit()

#________________________
# check quotes and create table

x = """CREATE TABLE Quote (
            QuoteID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            BookName VARCHAR(100) NOT NULL,
            Info TEXT NOT NULL,
            BookID INT,
            CONSTRAINT FK_QuoteBook FOREIGN KEY (BookID)
            REFERENCES Book(BookID)
            )""" 
mycursor.execute(x)


sql = "INSERT INTO Quote (BookName, Info, BookID ) VALUES (%s, %s, %s)"
val = [
    (x['bookName'] , x['info'] , int(x['bookId']) +1 ) for x in QUOTES
]
mycursor.executemany(sql, val)
mydb.commit()

#________________________
#check profile users
x = """CREATE TABLE User (
            UserID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            UserName VARCHAR(100) NOT NULL,
            PassWord VARCHAR(100) NOT NULL,
            Email VARCHAR(100) NOT NULL
            )""" 
mycursor.execute(x)
#________________________
#check likes on books 
x = """CREATE TABLE BookLike (
            BookID INT NOT NULL,
            UserID INT NOT NULL,
            PRIMARY KEY (BookID, UserID),
            CONSTRAINT FK_LikeBookUser FOREIGN KEY (UserID)
            REFERENCES User(UserID),
            CONSTRAINT FK_LikeBook FOREIGN KEY (BookID)
            REFERENCES Book(BookID)
            )""" 
mycursor.execute(x)
#________________________
#check likes on Quotes 
x = """CREATE TABLE QuoteLike (
            QuoteID INT NOT NULL,
            UserID INT NOT NULL,
            PRIMARY KEY (QuoteID, UserID),
            CONSTRAINT FK_LikeQuoteUser FOREIGN KEY (UserID)
            REFERENCES User(UserID),
            CONSTRAINT FK_LikeQuote FOREIGN KEY (QuoteID)
            REFERENCES Quote(QuoteID)
            )""" 
mycursor.execute(x)
#________________________
#check Comments on book table
x = """CREATE TABLE Comment (
            BookID INT NOT NULL,
            UserID INT NOT NULL,
            PRIMARY KEY (BookID, UserID),
            Comment TEXT NOT NULL,
            CONSTRAINT FK_CommentUser FOREIGN KEY (UserID)
            REFERENCES User(UserID),
            CONSTRAINT FK_CommentQuote FOREIGN KEY (BookID)
            REFERENCES Book(BookID)
            )""" 
mycursor.execute(x)
#________________________
#check added books table
x = """CREATE TABLE UserBooks (
            BookID INT NOT NULL,
            UserID INT NOT NULL,
            PRIMARY KEY (BookID, UserID),
            CONSTRAINT FK_AddUser FOREIGN KEY (UserID)
            REFERENCES User(UserID),
            CONSTRAINT FK_AddQuote FOREIGN KEY (BookID)
            REFERENCES Book(BookID)
            )""" 
mycursor.execute(x)