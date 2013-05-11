// Pressing Control-R will render this sketch.

int i = 0; 
int maxSize=100;
int minSize=20;

int count = 0;
int originX=500;
int originY=300;
float[][] e =new  float[500][8] ;

void setup() {  // this is run once.   
    
    // set the background color
    background(0);
    
    // canvas size (Integers only, please.)
    size(800, 500); 
    smooth();
    frameRate(35);
    strokeWeight(1);
} 
void draw() {  // this is run repeatedly. 
background(0);
    //stroke(random(50), random(255), random(255), 100);
	//stroke(0,255,255,100);
	noStroke();
	smooth();
	//fill(random(50), random(50), random(50));
     //fill(150,28,27,100);
	fill(255,255,255,50);
	if(mousePressed){
			createNewShape(mouseX,mouseY);
		    //line(mouseX, mouseY, random(0, width), random(0,height));
	}
	else
			//createNewShape(originX,originY);
				createNewShape(random(0,width),random(0,height));
	lights();
	
	for (int j=0;j< count;j++){	
	fill(e[j][5],e[j][6],e[j][7],100);
	radi=getRadii();
	ellipse(e[j][0],e[j][1],e[j][2],e[j][2]);
    e[j][0]+=e[j][3];
    e[j][1]+=e[j][4];
	diam=0;
	}
	if(count>=500)
	{
		count=0;
	}
}
void getRadii(){
	return random(maxSize,minSize);
}
void createShape(){
	ellipse(mouseX,mouseY,rad,rad)
}
void createNewShape(X,Y){
    e[count][0]=X; // X 
    e[count][1]=Y; // Y
    e[count][2]=random(minSize,maxSize); // Radius
    e[count][3]=random(-.5,.5); // X Speed
    e[count][4]=random(-.5,0); // Y Speed
	e[count][5]=random(150,200);
	e[count][6]=random(150,200);
	e[count][7]=random(150,200);
	count++;
} 