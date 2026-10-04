const API_BASE = "https://YOUR-BACKEND-DOMAIN.example.com";

const form=document.getElementById("form");
const urlInput=document.getElementById("url");
const statusEl=document.getElementById("status");
const result=document.getElementById("result");
const thumb=document.getElementById("thumb");
const title=document.getElementById("title");
const meta=document.getElementById("meta");
const download=document.getElementById("download");
const btn=document.getElementById("btn");

form.addEventListener("submit", async (e)=>{
  e.preventDefault();
  result.classList.add("hidden");
  statusEl.textContent="Checking link...";
  btn.disabled=true;
  try{
    const r=await fetch(`${API_BASE}/api/resolve`,{
      method:"POST",
      headers:{"Content-Type":"application/json"},
      body:JSON.stringify({url:urlInput.value.trim()})
    });
    const data=await r.json();
    if(!r.ok) throw new Error(data.error||"Request failed");
    title.textContent=data.title||"Kuaishou video";
    meta.textContent=data.duration ? `Duration: ${data.duration}` : "Ready to download";
    thumb.src=data.thumbnail||"";
    thumb.style.display=data.thumbnail?"block":"none";
    download.href=data.download_url;
    result.classList.remove("hidden");
    statusEl.textContent="Video is ready.";
  }catch(err){
    statusEl.textContent=err.message;
  }finally{
    btn.disabled=false;
  }
});
