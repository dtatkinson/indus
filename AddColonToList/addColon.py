filepath = "searchcodes.txt"
g = open("searchcodesC.txt","a+")

with open(filepath) as f:
    line = f.readline()
    count = 1
    while line:
        x = line.split("\t",1)
        g.write(x[0]+ ":"+ x[1])
        line = f.readline()
        count+=1

