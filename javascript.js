// Takes input and stores it as variables
function input() {
    var user = document.getElementById("user").value
    var token = document.getElementById("token").value
    var pie = document.getElementById('pie')

// Checks to see if charts exists from a previous user and deletes them if they do
    if (chart1 != null) chart1.destroy();
    if (chart3 != null) chart3.destroy();
    if (pie.scrollHeight != 0) pie.removeChild(pie.lastElementChild);

    main(user, token);
}
// Returns information from api and sends it to main
async function getRequest(url, token) {
    
    const response =  await fetch(url, {
        "method": "GET",
        "Authorization": "Token" + token,
    });
    
    let ans = await response.json();
    return ans;
}


async function main(user, token) {
   
    // Sends URL to getRequest to receive user and repo info and stores them in variables
    let url = "https://api.github.com/users/" + user;
    let basic_info = await getRequest(url, token).catch(error => console.error(error));
    
    url = "https://api.github.com/users/" + user + "/repos";
    let repo_info = await getRequest(url, token).catch(error => console.error(error));

    
    // Sends relevant info to functions to create charts and display basic information about the user
    user_info(basic_info);
    pie_chart_info(repo_info, user, token);
    polar_chart_info(repo_info, user, token);
    repo_chart_info(repo_info, user, token);
}

// Takes basicinfo from main and sends data to the html form
function user_info(basic_info) {
    let img = document.getElementById('img');
    img.src = basic_info.avatar_url

    let login = document.getElementById('login');
    login.innerHTML = `<b>Login ID: </b>${basic_info.login}`;

    let name = document.getElementById('name');
    name.innerHTML = `<b>Name: </b>${basic_info.name}`;

    let link = document.getElementById('link');
    link.innerHTML = `<b>Github URL: </b>${basic_info.html_url}`;

    let created_at = document.getElementById('created_at');
    created_at.innerHTML = `<b>Created On: </b>${basic_info.created_at}`;

    let followers = document.getElementById('followers');
    followers.innerHTML = `<b>Followers: </b>${basic_info.followers}`;

    let following = document.getElementById('following');
    following.innerHTML = `<b>Following: </b>${basic_info.following}`;
}

async function pie_chart_info(repo_info, user, token) {
    let data = [];
    let label = [];
//Takes number of lines of code in each language from a given repository and stores them in languages  
    for (i in repo_info) {
        let url = `https://api.github.com/repos/${user}/${repo_info[i].name}/languages`;
        let languages = await getRequest(url, token).catch(error => console.error(error));

        //Loops for each language in a given repository
        for (language in languages) {

            // Checks if a certain language is included in label yet. If already included in label it adds the lines of code to data. Otherwise it adds the language to label and the number of lines of code to data.  
            if (label.includes(language)) {
                for (i = 0; i < label.length; i++)
                    if (language == label[i])
                        data[i] = data[i] + languages[language];

            } else {
                label.push(language);
                data.push(languages[language]);
            }
        }

    }
    
    pie_chart(data,label);
}


async function polar_chart_info(repo_info, user, token) {
    let backgroundColour = [];
    let data = [];
    let label = [];
    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    // Loops for each repository
    for (i in repo_info) {
        let url = `https://api.github.com/repos/${user}/${repo_info[i].name}/commits?per_page=100`;
        let commits = await getRequest(url, token).catch(error => console.error(error));
        
        // Loops for each Commit
        for (j in commits) {
            let date = commits[j].commit.author.date;

            var d = new Date(date);
            let day = days[d.getDay()];
            // Checks if day is in label. If it is it adds 1 for each commit on that day. If not it adds it to label and adds 1 
            if (label.includes(day)) {
                for (i = 0; i < label.length; i++)
                    if (day == label[i])
                        data[i] += 1;

            } else {
                label.push(day);
                data.push(1);
                backgroundColour.push(`rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.5)`);
            }
        }

    }

    polar_chart(label, data, backgroundColour);
}


async function repo_chart_info(repo_info, user, token) {
    let label = [];
    let commits = [];
    let addition = [];
    let deletion = [];
    // Loops for each repository and adds each repository to label
    for (repo in repo_info) {
        let url = `https://api.github.com/repos/${user}/${repo_info[repo].name}/stats/contributors`;
        let stats = await getRequest(url, token).catch(error => console.log(error));
        label.push(repo_info[repo].name);

        // Loops for each result from the api and checks the login and user is the same. If they are it sets the commits, addition and deletion value value
        for (i in stats) {
            if (stats[i].author.login == user) {
                commits[repo] = stats[i].total;
                addition[repo] = 0;
                deletion[repo] = 0;
                // Loops for each week
                for (week in stats[i].weeks) {

                    addition[repo] += stats[i].weeks[week].a + 0;
                    deletion[repo] += stats[i].weeks[week].d + 0;
                }
            }
        }
    }
    // Filters the data to remove undefined values
    label = label.filter((x, i) => commits[i], addition[i], deletion[i])
    commits = commits.filter(x => x != undefined)
    addition = addition.filter(x => x != undefined)
    deletion = deletion.filter(x => x != undefined)

    
    repo_chart(label, commits, deletion, addition);
}

// Makes pie chart using d3js library
function pie_chart(data,label) {

    // set the dimensions and margins of the graph
    var width = 900
    height = 720
    margin = 72

// The radius of the pieplot is half the width or half the height (smallest one). I subtract a bit of margin.
var radius = Math.min(width, height) / 2 - margin

// append the svg object to the div called 'pie'
var svg = d3.select("#pie")
  .append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

// set the color scale
var color = d3.scaleOrdinal()
  .domain(data)
  .range(d3.schemeSet2);

// Compute the position of each group on the pie:
var pie = d3.pie()
  .value(function(d) {return d.value; })
var data_ready = pie(d3.entries(data))

// shape helper to build arcs:
var arcGenerator = d3.arc()
  .innerRadius(0)
  .outerRadius(radius)

// Build the pie chart as a series of paths that we build using the arc function.
svg
  .selectAll('mySlices')
  .data(data_ready)
  .enter()
  .append('path')
    .attr('d', arcGenerator)
    .attr('fill', function(d){ return(color(d.data.key)) })
    .attr("stroke", "black")
    .style("stroke-width", "2px")
    .style("opacity", 0.7)
// Add a Title
svg
    .append("text")
    .attr("x", 0)             
    .attr("y", -340)
    .attr("text-anchor", "middle")  
    .style("font-size", "30px") 
    .style("text-decoration", "underline")  
    .text("Most Common Languages Used");

// Adds the annotation for each language
svg
  .selectAll('mySlices')
  .data(data_ready)
  .enter()
  .append('text')
  .text(function(d){ return label[d.data.key]})
  .attr("transform", function(d) { return "translate(" + arcGenerator.centroid(d) + ")";  })
  .style("text-anchor", "middle")
  .style("font-size", 17)

}
// Creates polarchart using info from polar_chart_info()
function polar_chart(label, data, backgroundColour) {

    let myChart = document.getElementById("polarchart").getContext('2d');

    chart1 = new Chart(myChart, {
        type: "polarArea",
        data: {
            labels: label,
            datasets: [{
                label: "commits",
                data: data,
                backgroundColor: backgroundColour,
                borderWidth: 1,
                borderColor: '#777',
                hoverBorderWidth: 2,
                hoverBorderColor: '#000'
            }],

        },
        options: {
            title: {
                display: true,
                text: "Commits by Day",
                fontSize: 30
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: '#000'
                }
            },
            layout: {
                padding: {
                    left: 50,
                    right: 0,
                    bottom: 0,
                    top: 0
                }
            },
            tooltips: {
                enabled: true
            }
        }
    });
}


// Creates repository chart using info from repo_chart_info()
function repo_chart(datasetLabel, dataset1, dataset2, dataset3) {
    let myChart = document.getElementById("repochart").getContext('2d');

    chart3 = new Chart(myChart, {
        type: "bar",
        data: {
            labels: datasetLabel,
            datasets: [
            {
                type: "bar",
                label: 'Commits',
                backgroundColor: 'rgba(0, 0, 255, 0.5)',
                data: dataset1,
                borderColor: 'white',
                borderWidth: 1,
                hoverBorderWidth: 2,
                hoverBorderColor: '#000',
                yAxisID: 'yaxis'
            },
            {
                type: "bar",
                label: 'Deleteted Lines',
                backgroundColor: 'rgba(255, 0, 0, 0.5)',
                data: dataset2,
                borderColor: 'white',
                borderWidth: 1,
                hoverBorderWidth: 2,
                hoverBorderColor: '#000',
                yAxisID: 'yaxis'
            },
            {
                type: "bar",
                label: 'Inserted Lines',
                backgroundColor: 'rgba(0, 255, 0, 0.5)',
                data: dataset3,
                borderWidth: 1,
                hoverBorderWidth: 2,
                hoverBorderColor: '#000',
                yAxisID: 'yaxis'
            }]

        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: "Data by Repository",
                fontSize: 30
            }, 
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: '#000'
                }
            },
            tooltips: {
                mode: 'index',
                intersect: true,
                enabled: true
            },
            scales: {
                yAxes: [{
                    type: 'linear',
                    display: true,
                    position: 'left',
                    id: 'yaxis',
                },],
            }
        }
    });
}